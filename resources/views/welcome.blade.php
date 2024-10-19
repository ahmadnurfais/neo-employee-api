<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NeoEmployee - Comprehensive Employee Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Figtree, sans-serif;
            background-color: #f3f4f6;
            color: #111827;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #0ea5e9;
            margin-bottom: 1.5rem;
        }

        .description {
            font-size: 1.125rem;
            line-height: 1.75rem;
            margin-bottom: 2.5rem;
            color: #4b5563;
            text-align: justify;
        }

        a {
            display: inline-block;
            text-decoration: none;
            color: #0ea5e9;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }

        a:hover {
            background-color: #0ea5e9;
            color: #ffffff;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .feature-card {
            background-color: white;
            padding: 1.75rem;
            border-radius: 0.75rem;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.05);
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.1);
        }

        .feature-title {
            font-size: 1.5rem;
            color: #1f2937;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .technologies {
            background-color: #f9fafb;
            padding: 2rem 7rem;
            border-radius: 0.75rem;
            margin-top: 3rem;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.05);
        }

        .technologies-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .technologies-list {
            list-style: none;
            padding-left: 0;
            font-size: 1.125rem;
            line-height: 1.75rem;
            color: #4b5563;
            text-align: justify;
        }

        .technologies-list li {
            margin-bottom: 0.5rem;
        }

        .technologies-list strong {
            color: #0ea5e9;
        }

        .footer {
            margin-top: 3rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .footer p {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>NeoEmployee</h1>
        <div class="description">
            <p>NeoEmployee is a comprehensive employee management mobile application designed to streamline workplace
                operations and boost productivity. It is a versatile employee management solution that goes beyond just
                a mobile app. In addition to its Android-based mobile application, it features a powerful web-based
                admin dashboard that enables managers to effortlessly track, analyze, and manage all employee data.</p>

            <p>The admin dashboard offers robust reporting capabilities, allowing HR teams and managers to monitor
                attendance, tasks, project progress, leaves, overtime, and more—all in real time. With just a few
                clicks, users can generate detailed reports and export them in CSV or Excel format, providing convenient
                options for documentation or further company use.</p>

            <p>Beyond tracking attendance and tasks, NeoEmployee streamlines <strong>leave management</strong> and
                <strong>overtime approvals</strong>,
                simplifying HR processes and ensuring transparency across teams. Whether it's managing resources,
                tracking work hours, or facilitating seamless communication, NeoEmployee integrates it all into a
                user-friendly platform that boosts productivity and simplifies workplace operations.
            </p>
        </div>

        <div class="features">
            <div class="feature-card">
                <h2 class="feature-title">Smart Attendance System with GPS-based</h2>
                <p>Track employee attendance with GPS-based, ensuring accurate and location-verified attendance records.
                    Monitor working hours in real-time for multiple office locations.</p>
            </div>

            <div class="feature-card">
                <h2 class="feature-title">Task and Project Management</h2>
                <p>Assign tasks, track progress, and visualize projects with various views like Kanban or Calendar.
                    Easily manage tasks and subtasks to keep your teams on track.</p>
            </div>

            <div class="feature-card">
                <h2 class="feature-title">Employee Resources and Benefits Portal</h2>
                <p>Access comprehensive resources, employee benefits, and company policies all in one place.</p>
            </div>

            <div class="feature-card">
                <h2 class="feature-title">Company News Hub</h2>
                <p>Stay updated with the latest announcements, news, and corporate updates through a centralized news
                    hub.</p>
            </div>

            <div class="feature-card">
                <h2 class="feature-title">Emergency Report</h2>
                <p>Instantly report any workplace emergencies or issues, ensuring prompt action.</p>
            </div>

            <div class="feature-card">
                <h2 class="feature-title">Meeting Scheduler</h2>
                <p>Efficiently schedule meetings and book rooms in real-time.</p>
            </div>

            <div class="feature-card">
                <h2 class="feature-title">Interoffice Chat System</h2>
                <p>Real-time communication for employees across different departments, helping reduce email clutter and
                    improve team collaboration.</p>
            </div>
        </div>

        <div class="technologies">
            <h2 class="technologies-title">Technologies Used</h2>
            <ul class="technologies-list">
                <li><strong>Android (Kotlin)</strong> — Powers the mobile app for a seamless employee experience on
                    Android devices.</li>
                <li><strong>Laravel (PHP) & Flask (Python)</strong> — Backend technologies used for building and
                    managing the
                    server-side logic and APIs.</li>
                <li><strong>Laravel Filament & Laravel Livewire</strong> — Provide an intuitive, real-time admin
                    dashboard for managing employee data.</li>
                <li><strong>Laravel Shield</strong> — Handles user role management and permissions.</li>
                <li><strong>JWT (JSON Web Tokens)</strong> — Secures API authentication for safe and reliable access.
                </li>
                <li><strong>Databases:</strong> <b>MongoDB</b> as the primary database, <b>Firebase</b> (Firestore,
                    Auth, Cloud Messaging) for real-time data and communication services.</li>
            </ul>
        </div>

        <div class="footer">
            <p>Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
            <p><a href="{{ url('/api-docs') }}">View API Documentation</a></p>
        </div>
    </div>
</body>

</html>
