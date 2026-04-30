<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @auth
        @if(auth()->user()->role === 'admin')
            @vite(['resources/js/admin.js'])
        @endif

        <meta name="user-id" content="{{ auth()->id() }}">
    @endauth

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        /* Customizing Flatpickr to match your Tailwind Theme */
        .flatpickr-calendar {
            font-family: inherit;
            border: 1px solid #f3f4f6;
            /* Tailwind gray-100 */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
            /* Rounded-2xl */
            padding: 0.5rem;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected.inRange,
        .flatpickr-day.startRange.inRange,
        .flatpickr-day.endRange.inRange,
        .flatpickr-day.selected:focus,
        .flatpickr-day.startRange:focus,
        .flatpickr-day.endRange:focus,
        .flatpickr-day.selected:hover,
        .flatpickr-day.startRange:hover,
        .flatpickr-day.endRange:hover,
        .flatpickr-day.selected.prevMonthDay,
        .flatpickr-day.startRange.prevMonthDay,
        .flatpickr-day.endRange.prevMonthDay,
        .flatpickr-day.selected.nextMonthDay,
        .flatpickr-day.startRange.nextMonthDay,
        .flatpickr-day.endRange.nextMonthDay {
            background: #3b82f6;
            /* Tailwind blue-500 */
            border-color: #3b82f6;
        }

        .flatpickr-day:hover {
            background: #eff6ff;
            /* Tailwind blue-50 */
        }
    </style>
</head>