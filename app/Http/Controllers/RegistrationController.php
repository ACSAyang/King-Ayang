<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    // Staff: view all registrations.
    public function index()
    {
        $registrations = Registration::with('activity')
            ->latest()
            ->get();

        return view('registrations.index', compact('registrations'));
    }

    // Staff: display the participant encoding form.
    public function create()
    {
        $activities = Activity::where('status', 'active')
            ->orderBy('start_date')
            ->get();

        return view('registrations.create', compact('activities'));
    }

    // Staff: save a participant registration.
    public function store(Request $request)
    {
        $validated = $this->validateRegistration($request);

        $activity = Activity::findOrFail($validated['activity_id']);

        if (!$this->hasAvailableCapacity($activity)) {
            return back()
                ->withInput()
                ->withErrors([
                    'activity_id' => 'This activity has reached its registration capacity.'
                ]);
        }

        $validated['status'] = 'pending';

        Registration::create($validated);

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Registration created successfully and is pending approval.');
    }

    // Public: display activities open for registration.


    public function publicIndex()
    {
        $activities = Activity::where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('registration_deadline')
                    ->orWhereDate('registration_deadline', '>=', today());
            })
            ->where('end_date', '>=', now())
            ->orderBy('start_date')
            ->get();

        return view('registrations.public-index', compact('activities'));
    }


    // Public: display the registration form for an activity.
    public function publicCreate(Activity $activity)
    {
        abort_unless($this->isOpenForRegistration($activity), 404);

        return view('registrations.public-create', compact('activity'));
    }

    // Public: submit a participant registration.
    public function publicStore(Request $request, Activity $activity)
    {
        abort_unless($this->isOpenForRegistration($activity), 404);

        $validated = $this->validateRegistration($request);

        if (!$this->hasAvailableCapacity($activity)) {
            return back()
                ->withInput()
                ->withErrors([
                    'activity_id' => 'This activity has reached its registration capacity.'
                ]);
        }

        unset($validated['activity_id']);

        $activity->registrations()->create([
            ...$validated,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('registrations.public.index')
            ->with('success', 'Registration submitted successfully. Your status is pending approval.');
    }

    // Staff: approve or reject a registration.
    public function updateStatus(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['approved', 'rejected'])],
            'remarks' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($validated['status'] === 'approved') {
            $activity = $registration->activity;

            if (!$this->hasAvailableCapacity($activity, $registration)) {
                return back()->withErrors([
                    'status' => 'Cannot approve this registration because the activity is at capacity.'
                ]);
            }
        }

        $registration->update([
            'status' => $validated['status'],
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('registrations.index', $request->boolean('embedded') ? ['embedded' => 1] : [])
            ->with('success', 'Registration status updated successfully.');
    }

    private function validateRegistration(Request $request): array
    {
        return $request->validate([
            'activity_id' => ['required', 'integer', 'exists:activities,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'service_number' => ['nullable', 'string', 'max:100'],
            'rank' => ['nullable', 'string', 'max:100'],
            'unit' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:30'],
        ]);
    }

    private function isOpenForRegistration(Activity $activity): bool
    {
        return $activity->status === 'active'
            && $activity->end_date >= now()
            && (
                !$activity->registration_deadline
                || $activity->registration_deadline->toDateString() >= today()->toDateString()
            );
    }

    private function hasAvailableCapacity(
        Activity $activity,
        ?Registration $currentRegistration = null
    ): bool {
        if ($activity->capacity === null) {
            return true;
        }

        $count = $activity->registrations()
            ->whereIn('status', ['pending', 'approved'])
            ->when(
                $currentRegistration,
                fn($query) => $query->where('id', '!=', $currentRegistration->id)
            )
            ->count();

        return $count < $activity->capacity;
    }
}
