<x-guest-layout>
<div class="min-h-screen flex">

    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between overflow-hidden"
         style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 60%, #1d4ed8 100%);">

        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-10"
             style="background: radial-gradient(circle, #60a5fa, transparent)"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full opacity-10 translate-x-1/3 translate-y-1/3"
             style="background: radial-gradient(circle, #93c5fd, transparent)"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[460px] h-[460px] rounded-full border border-white/10"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full border border-white/5"></div>

        <div class="relative z-10 p-10">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <img src="{{ asset('img/hstu-logo.png') }}" alt="HSTU Logo" class="w-12 h-12 object-contain drop-shadow-lg">
                <div>
                    <p class="text-white font-bold text-lg leading-tight">HSTU</p>
                    <p class="text-blue-200 text-sm leading-tight">OBE Management</p>
                </div>
            </a>
        </div>

        <div class="relative z-10 flex-1 flex flex-col items-center justify-center px-12 text-center">
            <div class="w-24 h-24 rounded-2xl bg-white backdrop-blur-sm flex items-center justify-center mb-8 shadow-2xl ring-1 ring-white">
                <img src="{{ asset('img/hstu-logo.png') }}" alt="HSTU Logo" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-white text-4xl font-extrabold leading-tight tracking-tight drop-shadow">
                Join HSTU-OBE
            </h1>
            <p class="mt-2 text-blue-200 text-lg font-medium">Management of Outcome-Based Education</p>
            <p class="mt-4 text-white text-sm max-w-xs leading-relaxed">
                Create your account to access course outcomes, rubrics, grading plans, and analytics.
            </p>

            <div class="mt-10 flex flex-wrap justify-center gap-3">
                @foreach(['Course Outcomes', 'Grading Plans', 'Rubrics', 'Analytics'] as $feature)
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-blue-100 ring-1 ring-white/20 backdrop-blur-sm">
                    {{ $feature }}
                </span>
                @endforeach
            </div>
        </div>

        <div class="relative z-10 p-10 text-center">
            <p class="text-white text-xs">
                Hajee Mohammad Danesh Science &amp; Technology University
            </p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-gray-50 px-6 py-12 sm:px-12">

        <div class="flex lg:hidden flex-col items-center mb-8">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('img/hstu-logo.png') }}" alt="HSTU Logo" class="w-16 h-16 object-contain">
            </a>
            <p class="mt-2 text-gray-700 font-bold text-xl">HSTU-OBE</p>
            <p class="text-gray-500 text-xs">Management of Outcome-Based Education</p>
        </div>

        <div class="w-full max-w-md">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create your account</h2>
                <p class="mt-1 text-sm text-gray-500">Fill in your details to get started</p>
            </div>

            @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-red-700">Please fix the following errors:</p>
                        <ul class="mt-1 list-disc list-inside text-sm text-red-600 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Full name
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        autocomplete="name"
                        required
                        autofocus
                        value="{{ old('name') }}"
                        placeholder="Your full name"
                        class="block w-full px-4 py-2.5 rounded-lg border {{ $errors->has('name') ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 bg-white focus:ring-blue-500 focus:border-blue-500' }} text-gray-900 placeholder-gray-400 text-sm shadow-sm focus:outline-none focus:ring-2 transition"
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email address
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        class="block w-full px-4 py-2.5 rounded-lg border {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 bg-white focus:ring-blue-500 focus:border-blue-500' }} text-gray-900 placeholder-gray-400 text-sm shadow-sm focus:outline-none focus:ring-2 transition"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="new-password"
                            required
                            placeholder="Create a strong password"
                            class="block w-full pr-10 px-4 py-2.5 rounded-lg border {{ $errors->has('password') ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 bg-white focus:ring-blue-500 focus:border-blue-500' }} text-gray-900 placeholder-gray-400 text-sm shadow-sm focus:outline-none focus:ring-2 transition"
                        >
                        <button type="button" data-toggle-password="password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm password
                    </label>
                    <div class="relative">
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            placeholder="Re-enter your password"
                            class="block w-full pr-10 px-4 py-2.5 rounded-lg border {{ $errors->has('password_confirmation') ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 bg-white focus:ring-blue-500 focus:border-blue-500' }} text-gray-900 placeholder-gray-400 text-sm shadow-sm focus:outline-none focus:ring-2 transition"
                        >
                        <button type="button" data-toggle-password="password_confirmation"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-150">
                    Create account
                </button>
            </form>

            <p class="mt-5 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline transition">
                    Sign in
                </a>
            </p>

            <p class="mt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} HSTU &mdash; Outcome-Based Education System
            </p>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('[data-toggle-password]').forEach((button) => {
        button.addEventListener('click', () => {
            const inputId = button.getAttribute('data-toggle-password');
            const input = document.getElementById(inputId);

            if (!input) {
                return;
            }

            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });
</script>
</x-guest-layout>
