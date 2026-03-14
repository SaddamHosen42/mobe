<x-guest-layout>
<div class="min-h-screen flex">

    {{-- ── Left Branding Panel ── --}}
    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between overflow-hidden"
         style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 60%, #1d4ed8 100%);">

        {{-- Decorative circles --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-10"
             style="background: radial-gradient(circle, #60a5fa, transparent)"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full opacity-10 translate-x-1/3 translate-y-1/3"
             style="background: radial-gradient(circle, #93c5fd, transparent)"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[460px] h-[460px] rounded-full border border-white/10"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full border border-white/5"></div>

        {{-- Top logo area --}}
        <div class="relative z-10 p-10">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <img src="{{ asset('img/hstu-logo.png') }}" alt="HSTU Logo" class="w-12 h-12 object-contain drop-shadow-lg">
                <div>
                    <p class="text-white font-bold text-lg leading-tight">HSTU</p>
                    <p class="text-blue-200 text-sm leading-tight">OBE Management</p>
                </div>
            </a>
        </div>

        {{-- Centre callout --}}
        <div class="relative z-10 flex-1 flex flex-col items-center justify-center px-12 text-center">
            <div class="w-24 h-24 rounded-2xl bg-white backdrop-blur-sm flex items-center justify-center mb-8 shadow-2xl ring-1 ring-white">
                <img src="{{ asset('img/hstu-logo.png') }}" alt="HSTU Logo" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-white text-4xl font-extrabold leading-tight tracking-tight drop-shadow">
                HSTU-OBE
            </h1>
            <p class="mt-2 text-blue-200 text-lg font-medium">Management of Outcome-Based Education</p>
            <p class="mt-4 text-blue-300 text-sm max-w-xs leading-relaxed">
                Streamline curriculum design, grading plans, and student outcomes — all in one place.
            </p>

            {{-- Feature pills --}}
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                @foreach(['Course Outcomes', 'Grading Plans', 'Rubrics', 'Analytics'] as $feature)
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-blue-100 ring-1 ring-white/20 backdrop-blur-sm">
                    {{ $feature }}
                </span>
                @endforeach
            </div>
        </div>

        {{-- Footer note --}}
        <div class="relative z-10 p-10 text-center">
            <p class="text-white text-xs">
                Hajee Mohammad Danesh Science &amp; Technology University
            </p>
        </div>
    </div>

    {{-- ── Right Form Panel ── --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-gray-50 px-6 py-12 sm:px-12">

        {{-- Mobile logo --}}
        <div class="flex lg:hidden flex-col items-center mb-8">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('img/hstu-logo.png') }}" alt="HSTU Logo" class="w-16 h-16 object-contain">
            </a>
            <p class="mt-2 text-gray-700 font-bold text-xl">HSTU-OBE</p>
            <p class="text-gray-500 text-xs">Management of Outcome-Based Education</p>
        </div>

        <div class="w-full max-w-md">

            {{-- Heading --}}
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Welcome back</h2>
                <p class="mt-1 text-sm text-gray-500">Sign in to your account to continue</p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')"></x-auth-session-status>

            {{-- Validation Errors --}}
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

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email address
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                        </span>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            autofocus
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            class="block w-full pl-10 pr-4 py-2.5 rounded-lg border {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 bg-white focus:ring-blue-500 focus:border-blue-500' }} text-gray-900 placeholder-gray-400 text-sm shadow-sm focus:outline-none focus:ring-2 transition"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </span>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            placeholder="••••••••"
                            class="block w-full pl-10 pr-10 py-2.5 rounded-lg border {{ $errors->has('password') ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 bg-white focus:ring-blue-500 focus:border-blue-500' }} text-gray-900 placeholder-gray-400 text-sm shadow-sm focus:outline-none focus:ring-2 transition"
                        >
                        {{-- Show/hide toggle --}}
                        <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember me + Forgot --}}
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline transition">
                        Forgot password?
                    </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                    Sign in
                </button>
            </form>

            @if (Route::has('register'))
            <p class="mt-5 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline transition">
                    Please register
                </a>
            </p>
            @endif

            {{-- Footer --}}
            <p class="mt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} HSTU &mdash; Outcome-Based Education System
            </p>
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('togglePassword');
    const pwdInput = document.getElementById('password');
    const eyeIcon  = document.getElementById('eyeIcon');

    toggleBtn.addEventListener('click', () => {
        const isText = pwdInput.type === 'text';
        pwdInput.type = isText ? 'password' : 'text';
        eyeIcon.innerHTML = isText
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>`;
    });
</script>
</x-guest-layout>
