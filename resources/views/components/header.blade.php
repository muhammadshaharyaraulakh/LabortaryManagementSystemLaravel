@props(['title' => 'Laboratory Management System'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user-id" content="{{ auth()->id() }}">
        <meta name="user-role" content="{{ auth()->user()->role }}">
    @endauth

    @php
        $viteAssets = ['resources/css/app.css', 'resources/js/app.js'];

        if (auth()->check() && auth()->user()->role === 'Admin') {
            $viteAssets[] = 'resources/js/admin.js';
        }
    @endphp
    @vite($viteAssets)
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        .flatpickr-calendar {
            font-family: inherit;
            border: 1px solid #f3f4f6;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
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
            border-color: #3b82f6;
        }

        .flatpickr-day:hover {
            background: #eff6ff;
        }
    </style>
</head>