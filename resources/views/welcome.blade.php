<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HSTU-OBE | Outcome Based Education</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="leading-normal tracking-normal bg-slate-50 text-slate-700 antialiased">
<div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(186,230,253,0.45),_transparent_34%),radial-gradient(circle_at_bottom_right,_rgba(209,250,229,0.55),_transparent_30%),linear-gradient(180deg,_#f8fafc_0%,_#eef6ff_100%)]">
    <div class="w-full container mx-auto px-6 pt-6 lg:px-8">
        <div class="w-full flex items-center justify-between rounded-full border border-sky-200/80 bg-gradient-to-r from-sky-100 via-cyan-50 to-emerald-100 px-4 py-3 shadow-sm backdrop-blur">
            <a class="flex items-center text-slate-900 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
               href="{{ route('welcome') }}">
                <x-application-logo class="block h-14 pr-2 w-auto fill-current text-sky-600" />
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-700 via-cyan-600 to-emerald-600">HSTU-OBE</span>
            </a>

            <div class="flex w-1/2 justify-end content-center">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-700 md:px-6 md:py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 12H9m0 0l3-3m-3 3l3 3" />
                    </svg>
                    <span>Login</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container pt-16 md:pt-24 mx-auto flex flex-wrap flex-col-reverse md:flex-row items-center px-6 pb-12 lg:px-8">
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
            <span class="mb-4 inline-flex w-fit rounded-full bg-sky-100 px-4 py-1 text-sm font-semibold text-sky-700 ring-1 ring-sky-200">
                Welcome to the academic portal
            </span>

            <h1 class="my-4 text-4xl md:text-5xl text-slate-900 font-bold leading-tight text-center md:text-left">
                Welcome to <span class="text-sky-700">HSTU-OBE</span>.
            </h1>

            <p class="leading-relaxed text-slate-600 text-base md:text-xl mb-8 text-center md:text-left">
                HSTU-OBE is an application for managing student grades based on the Outcome-Based Education grading system in a cleaner and more organized workflow.
            </p>

            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-2xl bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 7.5V6a3 3 0 00-3-3H6a3 3 0 00-3 3v12a3 3 0 003 3h9a3 3 0 003-3v-1.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12h6m-3-3v6" />
                    </svg>
                    <span>Register</span>
                </a>

                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-sky-200 hover:text-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 12H9m0 0l3-3m-3 3l3 3" />
                    </svg>
                    <span>Login</span>
                </a>
            </div>
        </div>

        <div class="w-full xl:w-3/5 p-6 md:p-12 overflow-hidden">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-3 shadow-[0_25px_70px_-35px_rgba(15,23,42,0.35)]">
                <img
                    class="mx-auto w-full rounded-[1.5rem] object-cover transition hover:scale-[1.02] duration-500 ease-in-out"
                    src="{{ asset('img/hstu-main-gate.jpg') }}"
                    alt="HSTU main gate"
                >
            </div>
        </div>

    </div>

    <div class="container mx-auto px-6 pb-10 lg:px-8">
        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Course and CLO Mapping</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Organize courses, class settings, and course learning outcomes with a structure that supports department-level academic planning.
                </p>
            </div>

            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75m5.25 2.25a8.25 8.25 0 11-16.5 0 8.25 8.25 0 0116.5 0Z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Assessment Plans and Rubrics</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Build assignment plans, grading plans, criteria, and rubric levels so each evaluation stays consistent with the OBE framework.
                </p>
            </div>

            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7.5 18V6.75m4.5 11.25V9.75m4.5 8.25v-6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Student Performance Tracking</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Monitor grades, detailed score entries, and achievement reports to understand student progress across intended outcomes.
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-16 lg:px-8">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8 lg:p-10">
            <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div>
                    <span class="inline-flex rounded-full bg-sky-100 px-4 py-1 text-sm font-semibold text-sky-700 ring-1 ring-sky-200">
                        Academic workflow
                    </span>
                    <h2 class="mt-4 text-3xl font-bold text-slate-900">Built around the real OBE process</h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                        The portal is designed for faculty members, departments, and academic coordinators who need a single place to manage learning outcomes, grading criteria, and result analysis.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                        <p class="text-sm font-semibold text-sky-700">Step 1</p>
                        <h3 class="mt-2 text-lg font-bold text-slate-900">Define</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Set course outcomes, lesson outcomes, and assessment structure.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                        <p class="text-sm font-semibold text-emerald-700">Step 2</p>
                        <h3 class="mt-2 text-lg font-bold text-slate-900">Evaluate</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Use rubric-based criteria and planned tasks to record student performance.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                        <p class="text-sm font-semibold text-amber-700">Step 3</p>
                        <h3 class="mt-2 text-lg font-bold text-slate-900">Review</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Analyze grades and outcome attainment for better academic decisions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
