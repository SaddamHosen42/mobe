@php
    $title = Auth::user()->role == 'admin' ? __('All classes') : __('Your classes');
@endphp
@section('pageTitle', $title)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{ Breadcrumbs::render('classes.index') }}
        <div class="container pb-8">
            <div class="mb-6 flex flex-col gap-4 p-4 sm:flex-row sm:items-center sm:justify-between sm:px-0">
                <form action="{{ route('classes.index') }}" method="get" class="w-full sm:max-w-md">
                    <label class="input input-bordered flex items-center gap-2 rounded-xl border-slate-300 bg-white shadow-sm focus-within:border-slate-900 focus-within:ring-1 focus-within:ring-slate-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="text" name="search" placeholder="Search classes..." class="w-full border-none bg-transparent p-0 text-sm text-slate-700 placeholder:text-slate-400 focus:ring-0" value="{{ request('search') }}"/>
                    </label>
                </form>

                <div class="order-5 sm:order-6">
                    @if(Auth::user()->role == 'student')
                        <x-button-link href="{{route('classes.show_join')}}">
                            <i class="fa fa-plus"></i> {{ __('Join Class') }}
                        </x-button-link>
                    @else
                        <x-button-link href="{{ route('classes.create') }}">
                            <i class="fa fa-plus"></i> {{ __('Create Class') }}
                        </x-button-link>
                    @endif
                </div>
            </div>
            @if($classes->count() > 0)
                <ul class="mb-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($classes as $class)
                        <li class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <a href="{{ route('classes.show', $class) }}" class="relative block overflow-hidden">
                                @php
                                    $isUrl = filter_var($class->thumbnail_img, FILTER_VALIDATE_URL);
                                    if (empty($class->thumbnail_img)) {
                                        $class->thumbnail_img = "https://via.placeholder.com/374x210/1E293B/FFFFFF?text=$class->name";
                                    } else {
                                        $class->thumbnail_img = $isUrl ? $class->thumbnail_img : url('storage/' . substr($class->thumbnail_img, 6));
                                    }
                                @endphp
                                <img src="{{ $class->thumbnail_img }}" alt="{{ $class->name }}" class="aspect-[16/9] w-full object-cover">
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/20 to-transparent opacity-90"></div>
                                <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold tracking-wide text-slate-700 shadow-sm">
                                    {{ __('Class') }}
                                </span>
                            </a>

                            <header class="p-5">
                                <h2 class="text-lg font-bold tracking-tight text-slate-900 md:text-xl">
                                    <a href="{{ route('classes.show', $class) }}" class="transition group-hover:text-slate-700">{{ $class->name }}</a>
                                </h2>

                                <ul class="mt-4 flex flex-wrap items-center gap-3 text-sm text-slate-700">
                                    <li class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5">
                                        <i class="fa-solid fa-graduation-cap text-slate-600"></i>
                                        <span class="truncate">{{ $class->course->name }}</span>
                                    </li>

                                    <li class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5">
                                        <i class="fa-solid fa-users-rectangle text-slate-600"></i>
                                        <span>{{ $class->students->count()." students" }}</span>
                                    </li>
                                </ul>
                            </header>
                        </li>
                    @endforeach
                </ul>
                {{ $classes->links() }}
            @else
                <div class="text-center">
                    <p class="text-gray-500">{{ __('No classes found.') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
