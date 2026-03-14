@section('pageTitle', "Home")

<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-200/70 bg-gradient-to-br from-slate-50 via-white to-cyan-50/60 p-4 shadow-sm sm:p-6 lg:p-8">
            <div class="grid gap-6 xl:grid-cols-12">
                <div class="xl:col-span-6">
                    <div class="relative h-full overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/50 sm:p-7">
                        <div class="pointer-events-none absolute -right-8 -top-10 h-40 w-40 rounded-full bg-cyan-100 blur-3xl"></div>
                        <div class="pointer-events-none absolute -left-8 bottom-0 h-36 w-36 rounded-full bg-emerald-100 blur-3xl"></div>

                        <div class="relative">
                            <div class="flex items-start gap-4">
                                <div class="h-24 w-24 shrink-0 rounded-3xl bg-gradient-to-br from-cyan-500 to-sky-600 p-[3px] shadow-lg shadow-cyan-200/60">
                                    <div class="h-full w-full rounded-[1.1rem] bg-white p-1">
                                        <img src="{{ $user->profile_photo_url }}"
                                             width="94"
                                             height="94"
                                             alt="{{ $user->name }}"
                                            onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 256 256%22%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22%23E5E7EB%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial,%20sans-serif%22 font-size=%2290%22 fill=%22%23374151%22%3E{{ strtoupper(substr($user->name, 0, 1)) }}%3C/text%3E%3C/svg%3E';"
                                             class="h-full w-full rounded-xl object-cover">
                                    </div>
                                </div>

                                <div class="min-w-0 flex-1 pt-1">
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-700">Profile</p>
                                    <h2 class="mt-1 truncate text-2xl font-extrabold tracking-tight text-slate-900">{{ $user->name }}</h2>
                                    <p class="mt-1 truncate text-sm text-slate-500">{{ $user->email }}</p>
                                    <span class="mt-3 inline-flex rounded-full bg-slate-900 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.12em] text-white">
                                        {{ $user->role }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6 space-y-3">
                                <div class="rounded-2xl border border-slate-200/90 bg-white/80 px-4 py-3">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Role</p>
                                    <p class="mt-1 text-sm font-semibold text-slate-700">{{ ucfirst($user->role) }}</p>
                                </div>

                                @can('is-student')
                                    <div class="rounded-2xl border border-slate-200/90 bg-white/80 px-4 py-3">
                                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Student Number</p>
                                        @if(!empty($user->studentData->student_id_number))
                                            <p class="mt-1 text-sm font-semibold text-slate-700">{{ $user->studentData->student_id_number }}</p>
                                        @else
                                            <p class="mt-1 text-sm font-semibold text-rose-600">No student number</p>
                                        @endif
                                    </div>
                                @endcan
                            </div>

                            <a href="{{ route('profile.show') }}"
                               class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-600 to-sky-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:from-cyan-700 hover:to-sky-700 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2">
                                <span>Go to profile</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                @canany(['is-teacher', 'is-student'])
                    <div class="xl:col-span-6">
                        <div class="h-full rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-lg shadow-cyan-100/30 backdrop-blur">
                            @php($classesList = is_iterable($classes) ? $classes : [])
                            @php($classesCount = is_countable($classesList) ? count($classesList) : 0)
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-lg font-bold text-slate-900">
                                    <a href="{{ route('classes.index') }}" class="hover:text-cyan-700">
                                        Your Classes
                                    </a>
                                </h3>
                                <span class="rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">
                                    {{ $classesCount }}
                                </span>
                            </div>

                            <ul class="space-y-2">
                                @if($classesCount > 0)
                                    @foreach($classesList as $class)
                                        <li>
                                            <a href="{{ route('classes.show', data_get($class, 'id')) }}"
                                               class="group flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-700 transition hover:border-cyan-300 hover:bg-cyan-50/50 hover:text-cyan-900">
                                                <span class="flex items-center gap-3">
                                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-600 transition group-hover:bg-cyan-100 group-hover:text-cyan-700">
                                                        <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4 w-4 stroke-current">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="font-medium">{{ data_get($class, 'name') }}</span>
                                                </span>
                                                <span class="text-slate-400 transition group-hover:text-cyan-700">&rarr;</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-600">
                                        @can('is-teacher')
                                            You are not teaching any class yet
                                        @else
                                            You are not enrolled in any class yet
                                        @endcan
                                    </li>
                                @endif
                            </ul>

                            @php($btnText = $user->role == "teacher" ? __('Create Class'): __('Join Class'))
                            @php($btnLink = $user->role == "teacher" ? route('classes.create'): route('classes.show_join'))
                            <a href="{{ $btnLink }}"
                               class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                <span>{{ $btnText }}</span>
                            </a>
                        </div>
                    </div>
                @endcanany

                @can('is-admin')
                    <div class="xl:col-span-6">
                        <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-900 to-cyan-900 p-6 text-white shadow-lg shadow-cyan-900/20">
                            <div class="mb-5 flex items-start justify-between">
                                <h3 class="text-base font-semibold uppercase tracking-wide text-cyan-100">Academic Overview</h3>
                                <a href="{{ route('faculties.index') }}"
                                   aria-label="Go to faculties"
                                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white transition hover:bg-white/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <dl class="space-y-4">
                                <div class="rounded-xl bg-white/10 px-4 py-3">
                                    <dt class="text-xs uppercase tracking-wide text-cyan-100">Faculties</dt>
                                    <dd class="mt-1 text-3xl font-bold">{{ $facultiesCount }}</dd>
                                </div>
                                <div class="rounded-xl bg-white/10 px-4 py-3">
                                    <dt class="text-xs uppercase tracking-wide text-cyan-100">Departments</dt>
                                    <dd class="mt-1 text-3xl font-bold">{{ $departmentsCount }}</dd>
                                </div>
                                <div class="rounded-xl bg-white/10 px-4 py-3">
                                    <dt class="text-xs uppercase tracking-wide text-cyan-100">Study Programs</dt>
                                    <dd class="mt-1 text-3xl font-bold">{{ $studyProgramsCount }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="xl:col-span-12">
                        <div class="h-full rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-lg shadow-cyan-100/30 backdrop-blur">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-lg font-bold text-slate-900">Courses</h3>
                                <a href="{{ route('courses.index') }}"
                                   class="text-sm font-semibold text-cyan-700 transition hover:text-cyan-900">
                                    See More
                                </a>
                            </div>

                            <ul class="space-y-2">
                                @if(!empty($courses))
                                    @foreach($courses as $course)
                                        <li>
                                            <a href="{{ route('courses.show', $course) }}"
                                               class="group flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-700 transition hover:border-cyan-300 hover:bg-cyan-50/50 hover:text-cyan-900">
                                                <span class="font-medium">{{ $course->name }}</span>
                                                <span class="text-slate-400 transition group-hover:text-cyan-700">&rarr;</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-600">
                                        No classes have been created yet
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
