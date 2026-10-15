<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Management System</title>



    <style>
        :root {
            --navy: #102744;
            --navy-light: #193b63;
            --navy-hover: #234b76;
            --blue: #2563eb;
            --blue-hover: #1d4ed8;
            --background: #f3f6fb;
            --surface: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --radius: 14px;
            --shadow: 0 4px 18px rgba(15, 35, 65, 0.045);
            --shadow-hover: 0 12px 28px rgba(15, 35, 65, 0.09);
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        a,
        button {
            -webkit-tap-highlight-color: transparent;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 3px;
        }

        /* Main application layout */

        .app {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Sidebar */

        .sidebar {
            width: 268px;
            flex: 0 0 268px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #102744 0%, #142f50 100%);
            color: #ffffff;
            position: relative;
            z-index: 2;
            box-shadow: 5px 0 24px rgba(15, 35, 65, 0.07);
        }

        .brand {
            padding: 29px 23px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        }

        .brand h2 {
            margin: 0 0 9px;
            font-size: 19px;
            font-weight: 750;
            line-height: 1.4;
            letter-spacing: -0.45px;
            color: #ffffff;
        }

        .brand p {
            margin: 0;
            color: #b7c9df;
            font-size: 12px;
            line-height: 1.75;
        }

        .nav-heading {
            padding: 26px 24px 11px;
            color: #8fa9c8;
            font-size: 10px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 46px;
            padding: 12px 16px;
            margin: 3px 12px;
            border: 1px solid transparent;
            border-radius: 10px;
            color: #d5e1ef;
            text-decoration: none;
            font-size: 13px;
            font-weight: 550;
            line-height: 1.5;
            transition:
                background 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.075);
            border-color: rgba(255, 255, 255, 0.045);
        }

        .nav-link:active {
            transform: scale(0.99);
        }

        .nav-link.active {
            color: #ffffff;
            background: linear-gradient(100deg, #244b78, #1c416c);
            border-color: rgba(147, 197, 253, 0.13);
            box-shadow: inset 3px 0 0 #60a5fa;
        }

        .nav-icon {
            width: 23px;
            flex: 0 0 23px;
            text-align: center;
            font-size: 18px;
            line-height: 1;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 16px 12px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.10);
        }

        .user-info {
            padding: 12px 10px 15px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 650;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .user-info small {
            display: block;
            margin-top: 4px;
            color: #b3c5db;
            font-size: 11px;
            font-weight: 400;
            text-transform: capitalize;
        }

        .logout-button {
            width: 100%;
            min-height: 43px;
            padding: 11px 14px;
            border: 1px solid rgba(203, 213, 225, 0.3);
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.035);
            color: #ffffff;
            cursor: pointer;
            font-size: 12px;
            font-weight: 650;
            transition:
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .logout-button:hover {
            background: rgba(255, 255, 255, 0.10);
            border-color: rgba(203, 213, 225, 0.55);
        }

        /* Main content area */

        .main {
            flex: 1 1 auto;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            min-height: 84px;
            padding: 20px 34px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            background: rgba(255, 255, 255, 0.97);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(15, 35, 65, 0.02);
        }

        .topbar h1 {
            margin: 0;
            color: #14263f;
            font-size: 22px;
            font-weight: 750;
            line-height: 1.4;
            letter-spacing: -0.6px;
            overflow-wrap: anywhere;
        }

        .topbar p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            width: 100%;
            max-width: 1800px;
            margin: 0 auto;
            padding: 32px 34px;
        }

        /* Welcome section */

        .welcome {
            margin-bottom: 28px;
        }

        .welcome h2 {
            margin: 0 0 10px;
            color: #14263f;
            font-size: 27px;
            font-weight: 750;
            line-height: 1.35;
            letter-spacing: -0.75px;
            overflow-wrap: anywhere;
        }

        .welcome p {
            max-width: 760px;
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
        }

        /* Dashboard statistics */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 19px;
            margin-bottom: 28px;
        }

        .stat-card {
            --card-accent: #2563eb;

            position: relative;
            min-width: 0;
            padding: 24px 23px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: 4px solid var(--card-accent);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition:
                transform 0.22s ease,
                box-shadow 0.22s ease,
                border-color 0.22s ease;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 92px;
            height: 92px;
            right: -36px;
            bottom: -43px;
            border-radius: 50%;
            background: var(--card-accent);
            opacity: 0.055;
            pointer-events: none;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .stat-card .label {
            position: relative;
            z-index: 1;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            line-height: 1.7;
            letter-spacing: 0.35px;
            text-transform: uppercase;
            overflow-wrap: anywhere;
        }

        .stat-card .number {
            position: relative;
            z-index: 1;
            margin-top: 15px;
            color: var(--card-accent);
            font-size: clamp(26px, 2.1vw, 34px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            overflow-wrap: anywhere;
        }

        .stat-card.activities {
            --card-accent: #2563eb;
        }

        .stat-card.registrations {
            --card-accent: #7c3aed;
        }

        .stat-card.pending {
            --card-accent: #d97706;
        }

        .stat-card.approved {
            --card-accent: #16a34a;
        }

        /* Panels */

        .panel {
            min-width: 0;
            margin-bottom: 25px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 21px 24px;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            color: #1e293b;
            font-size: 14px;
            font-weight: 750;
            line-height: 1.6;
        }

        /* Tables */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th,
        td {
            padding: 16px 22px;
            border-bottom: 1px solid #edf1f6;
            text-align: left;
            font-size: 12px;
            line-height: 1.6;
            vertical-align: middle;
        }

        th {
            background: #f7f9fc;
            color: #64748b;
            font-size: 10px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: 0.65px;
        }

        td {
            color: #334155;
        }

        tbody tr {
            transition: background 0.16s ease;
        }

        tbody tr:hover {
            background: #f7faff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Registration status badges */

        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            max-width: 100%;
            padding: 6px 11px;
            border: 1px solid transparent;
            border-radius: 999px;
            background: #e2e8f0;
            color: #334155;
            font-size: 10px;
            font-weight: 750;
            line-height: 1.4;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status.approved {
            background: #dcfce7;
            border-color: #bbf7d0;
            color: #166534;
        }

        .status.pending {
            background: #fef3c7;
            border-color: #fde68a;
            color: #92400e;
        }

        .status.rejected {
            background: #fee2e2;
            border-color: #fecaca;
            color: #991b1b;
        }

        /* Quick actions */

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            gap: 13px;
            padding: 23px 24px;
            background: var(--surface);
            border-radius: 0 0 var(--radius) var(--radius);
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 44px;
            padding: 12px 17px;
            border: 1px solid var(--blue);
            border-radius: 9px;
            background: var(--blue);
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.5;
            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .action-link:hover {
            transform: translateY(-2px);
            background: var(--blue-hover);
            border-color: var(--blue-hover);
            box-shadow: 0 5px 12px rgba(37, 99, 235, 0.17);
            color: #ffffff;
        }

        .action-link:active {
            transform: translateY(0);
        }

        /* Success messages */

        .notice {
            margin-bottom: 22px;
            padding: 15px 18px;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #16a34a;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 13px;
            line-height: 1.7;
        }

        /* Embedded Laravel modules
       Keeps the existing iframe navigation working. */

        .embedded-panel {
            display: none;
            width: 100%;
            min-width: 0;
            min-height: calc(100vh - 130px);
            overflow: visible;
            background: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }

        .embedded-panel iframe {
            display: block;
            width: 100%;
            height: calc(100vh - 170px);
            min-height: 600px;
            border: none;
            background: transparent;
        }

        /* Tablet and smaller laptops */

        @media (max-width: 1200px) {
            .sidebar {
                width: 245px;
                flex-basis: 245px;
            }

            .main-content {
                padding: 27px 25px;
            }

            .topbar {
                padding-right: 25px;
                padding-left: 25px;
            }

            .stats {
                gap: 14px;
            }

            .stat-card {
                padding: 21px 18px;
            }
        }

        @media (max-width: 1000px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .stat-card .number {
                font-size: 30px;
            }
        }

        /* Mobile layout */

        @media (max-width: 700px) {
            .app {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex: 0 0 auto;
                min-height: auto;
                box-shadow: 0 4px 15px rgba(15, 35, 65, 0.08);
            }

            .brand {
                padding: 18px 20px;
            }

            .brand h2 {
                font-size: 18px;
            }

            .nav-heading {
                padding: 17px 20px 8px;
            }

            .nav-link {
                min-height: 43px;
                margin: 3px 10px;
                padding: 11px 14px;
            }

            .sidebar-bottom {
                margin-top: 12px;
                padding: 12px 10px 15px;
            }

            .topbar {
                min-height: auto;
                padding: 18px 19px;
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            .topbar h1 {
                font-size: 20px;
            }

            .main-content {
                padding: 22px 16px;
            }

            .welcome {
                margin-bottom: 22px;
            }

            .welcome h2 {
                font-size: 23px;
            }

            .welcome p {
                font-size: 12px;
            }

            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
                margin-bottom: 22px;
            }

            .stat-card {
                padding: 18px 15px;
                border-radius: 12px;
            }

            .stat-card .label {
                font-size: 10px;
            }

            .stat-card .number {
                margin-top: 12px;
                font-size: 27px;
            }

            .panel {
                margin-bottom: 20px;
            }

            .panel-header {
                padding: 17px;
                font-size: 13px;
            }

            th,
            td {
                padding: 13px 15px;
            }

            .quick-actions {
                padding: 16px;
                gap: 10px;
            }

            .action-link {
                flex: 1 1 100%;
                min-height: 45px;
                justify-content: center;
            }

            .embedded-panel {
                min-height: 75vh;
            }

            .embedded-panel iframe {
                height: 75vh;
                min-height: 500px;
            }
        }

        /* Very small phones */

        @media (max-width: 380px) {
            .main-content {
                padding-right: 12px;
                padding-left: 12px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 18px;
            }

            .stat-card .number {
                font-size: 29px;
            }

            .topbar h1 {
                font-size: 18px;
            }
        }

        /* Respect reduced-motion preferences */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
            }
        }
    </style>


</head>

<body>
    <div class="app">

        <aside class="sidebar">
            <div class="brand">
                <h2>Activity Management</h2>
                <p>Registration and Monitoring System</p>
            </div>

            <div class="nav-heading">Main Menu</div>

            <a href="{{ route('dashboard') }}" class="nav-link active" data-page="home" data-title="Dashboard">
                <span class="nav-icon">⌂</span>
                Dashboard
            </a>

            <a href="{{ route('activities.index') }}" class="nav-link" data-page="{{ route('activities.index') }}"
                data-title="Activities">
                <span class="nav-icon">▣</span>
                Activities
            </a>

            <a href="{{ route('registrations.index') }}" class="nav-link" data-page="{{ route('registrations.index') }}"
                data-title="Registrations">
                <span class="nav-icon">♙</span>
                Registrations
            </a>

            <a href="{{ route('registrations.create') }}" class="nav-link"
                data-page="{{ route('registrations.create') }}" data-title="Encode Registration">
                <span class="nav-icon">＋</span>
                Encode Registration
            </a>

            <a href="{{ url('/register') }}" class="nav-link" data-page="{{ url('/register') }}"
                data-title="Public Registration">
                <span class="nav-icon">↗</span>
                Public Registration
            </a>

            @if (auth()->user()->role === 'admin')
                <div class="nav-heading">Administration</div>

                <a href="{{ route('users.index') }}" class="nav-link" data-page="{{ route('users.index') }}"
                    data-title="User Management">
                    <span class="nav-icon">♙</span>
                    User Management
                </a>
            @endif

            <div class="sidebar-bottom">
                <div class="user-info">
                    {{ auth()->user()->name }}
                    <small>{{ auth()->user()->role }}</small>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        ⇥ &nbsp; Log Out
                    </button>
                </form>
            </div>
        </aside>

        <main class="main">
            <header class="topbar">
                <div>
                    <h1 id="page-title">Dashboard</h1>
                    <p>Activity Registration and Management System</p>
                </div>
                <div style="font-size:13px;color:#64748b;">
                    Signed in as {{ auth()->user()->name }}
                </div>
            </header>

            <div class="main-content">

                @if (session('success'))
                    <div class="notice">{{ session('success') }}</div>
                @endif

                <section id="dashboard-home">
                    <div class="welcome">
                        <h2>Welcome, {{ auth()->user()->name }}!</h2>
                        <p>
                            Manage activities, participant registrations, and
                            administrative tasks from one place.
                            Select a module from the sidebar to get started.
                        </p>
                    </div>

                    <div class="stats">
                        <div class="stat-card activities">
                            <div class="label">Total Activities</div>
                            <div class="number">{{ $totalActivities }}</div>
                        </div>

                        <div class="stat-card registrations">
                            <div class="label">Total Registrations</div>
                            <div class="number">{{ $totalRegistrations }}</div>
                        </div>

                        <div class="stat-card pending">
                            <div class="label">Pending Registrations</div>
                            <div class="number">{{ $pendingRegistrations }}</div>
                        </div>

                        <div class="stat-card approved">
                            <div class="label">Approved Registrations</div>
                            <div class="number">{{ $approvedRegistrations }}</div>
                        </div>
                    </div>

                    <div class="panel" style="margin-bottom:22px;">
                        <div class="panel-header">Quick Actions</div>
                        <div class="quick-actions">
                            <a href="{{ route('activities.index') }}" class="action-link"
                                data-page="{{ route('activities.index') }}" data-title="Activities">
                                ▣ Manage Activities
                            </a>

                            <a href="{{ route('registrations.index') }}" class="action-link"
                                data-page="{{ route('registrations.index') }}" data-title="Registrations">
                                ♙ View Registrations
                            </a>

                            <a href="{{ route('registrations.create') }}" class="action-link"
                                data-page="{{ route('registrations.create') }}" data-title="Encode Registration">
                                ＋ Encode Registration
                            </a>

                            <a href="{{ url('/register') }}" class="action-link" data-page="{{ url('/register') }}"
                                data-title="Public Registration">
                                ↗ Public Registration
                            </a>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-header">Recent Registrations</div>

                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Participant</th>
                                        <th>Activity</th>
                                        <th>Status</th>
                                        <th>Date Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentRegistrations as $registration)
                                        <tr>
                                            <td>{{ $registration->full_name }}</td>
                                            <td>
                                                {{ $registration->activity?->title ?? 'Activity unavailable' }}
                                            </td>
                                            <td>
                                                <span class="status {{ $registration->status }}">
                                                    {{ $registration->status }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $registration->created_at?->format('d M Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align:center;color:#64748b;">
                                                No registrations have been recorded yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section id="embedded-panel" class="embedded-panel">
                    <iframe id="module-frame" title="Dashboard module" src="about:blank">
                    </iframe>
                </section>

            </div>
        </main>
    </div>

    <script>
        const homePanel = document.getElementById('dashboard-home');
        const embeddedPanel = document.getElementById('embedded-panel');
        const moduleFrame = document.getElementById('module-frame');
        const pageTitle = document.getElementById('page-title');
        const navLinks = document.querySelectorAll('.nav-link[data-page]');

        function openModule(url, title, clickedLink) {
            if (url === 'home') {
                embeddedPanel.style.display = 'none';
                homePanel.style.display = 'block';
                pageTitle.textContent = 'Dashboard';
            } else {
                homePanel.style.display = 'none';
                embeddedPanel.style.display = 'block';


                const targetUrl = new URL(url, window.location.origin);
                targetUrl.searchParams.set('embedded', '1');

                if (moduleFrame.src !== targetUrl.href) {
                    moduleFrame.src = targetUrl.href;
                }


                pageTitle.textContent = title || 'Module';
            }

            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });

            if (clickedLink && clickedLink.classList.contains('nav-link')) {
                clickedLink.classList.add('active');
            } else if (url === 'home') {
                const dashboardLink = document.querySelector(
                    '.nav-link[data-page="home"]'
                );

                if (dashboardLink) {
                    dashboardLink.classList.add('active');
                }
            }
        }

        document.querySelectorAll('[data-page]').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                openModule(
                    this.dataset.page,
                    this.dataset.title,
                    this.classList.contains('nav-link') ? this : null
                );
            });
        });
    </script>

</body>

</html>
