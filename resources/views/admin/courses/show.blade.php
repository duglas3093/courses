<x-app-layout>
    <section class="bg-gray-700 py-12 mb-12">
        <div class="container grid grid-cols-1 lg:grid-cols-2 gap-6">
            <figure>
                @if ($course->image)
                    {{-- <img class="h-60 w-full object-cover" src="{{ Storage::url($course->image->url) }}" alt=""> --}}
                    <img class="h-60 w-full object-cover" src="{{ asset('storage/'.$course->image->url) }}" alt="">
                @else
                    <img class="h-60 w-full object-cover" src="https://cdn.pixabay.com/photo/2017/12/29/11/46/coffee-3047385_960_720.jpg" alt="">
                @endif
            </figure>
            <div class="text-white">
                <h1 class="text-4xl">{{ $course->title }}</h1>
                <h2 class="text-xl mb-3">{{ $course->subtitle }}</h2>
                <p class="mb-2"><i class="fas fa-chart-line"></i> Nivel: {{ $course->level->name }}</p>
                <p class="mb-2"><i class=""></i> Categoria: {{ $course->category->name }}</p>
                <p class="mb-2"><i class="fas fa-users"></i> Matriculados: {{ $course->students_count }}</p>
                <p><i class="far fa-star"></i> Calificación: {{ $course->rating }}</p>
            </div>
        </div>
    </section>
    
    <div class="container grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        @if (session('info'))
            <div class="lg:col-span-3" x-data="{ open: true }" x-show="open">
                <div class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                    <strong class="font-bold">Ocurrio un error</strong>
                    <span class="block sm:inline">{{ session('info') }}</span>
                    <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                        <svg x-on:click="open = false" class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                    </span>
                </div>
            </div>
        @endif

        <div class="order-2 lg:col-span-2 lg:order-1">
            {{-- METAS --}}
            <section class="card mb-12">
                <div class="card-body">
                    <h1 class="font-bold text-2xl mb-2">Lo que aprenderas</h1>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        @forelse ($course->goals as $goal)
                            <li class="text-gray-700 text-base"><i class="fas fa-check tex-gray-600 mr-2"></i> {{ $goal->name }}</li>
                        @empty
                            <li class="text-gray-700 text-base">Este curso no tiene asignado ninguna meta</li>
                        @endforelse
                    </ul>
                </div>
            </section>
            {{-- TEMARIO --}}
            <section class="mb-12">
                <h1 class="font-bold text-3xl mb-2">Temario</h1>

                @forelse ($course->sections as $section)
                    <article class="mb-4 shadow" 
                        @if ($loop->first)
                            x-data="{ open: true }"
                        @else
                            x-data="{ open: false }"
                        @endif>
                        <header class="border border-gray-200 px-4 py-2 cursor-pointer bg-gray-200" x-on:click="open = !open">
                            <h1 class="font-bold text-lg text-gray-600">{{ $section->name }}</h1>
                        </header>
                        <div class="bg-white py-2 px-4" x-show="open">
                            <ul class="grid grid-cols-1 gap-2">
                                @foreach ($section->lessons as $lesson)
                                    <li class="text-gray-700 text-base"><i class="fas fa-play-circle mr-2 text-gray-600"></i>{{ $lesson->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @empty
                    <div class="card">
                        <div class="card-body">
                            Este curso no tiene ninguna sección asignada
                        </div>
                    </div>
                @endforelse

            </section>
            {{-- REQUISITOS --}}
            <section class="mb-8">
                <h1 class="font-bold text-3xl">Requisitos</h1>
                <ul class="list-disc list-inside">
                    @forelse ($course->requirements as $requirement)
                        <li class="text-gray-700 text-base">{{ $requirement->name }}</li>
                    @empty    
                        <li class="text-gray-700 text-base">No se registro ningun requisito</li>
                    @endforelse
                </ul>
            </section>
            {{-- DESCRIPCION --}}
            <section>
                <h1 class="font-bold text-3xl">Descripción</h1>
                <div class="text-gray-700 text-base">{!! $course->description !!}</div>
            </section>
        </div>
        <div class="order-1 lg:order-2">
            <section class="card mb-4">
                <div class="card-body">
                    <div class="flex items-center">
                        <img class="h-12 w-12 object-cover rounded-full shadow-lg"src="{{ $course->teacher->profile_photo_url }}" alt="{{ $course->teacher->name }}">
                        <div class="ml-4">
                            <h1 class="font-bold text-gray-500 text-lg">Prof. {{ $course->teacher->name }}</h1>
                            <a class="text-blue-400 text-sm font-bold" href="">{{ '@'.Str::slug($course->teacher->name,'') }}</a>
                        </div>
                    </div>
                    <div class="flex">
                        <div>
                            <form action="{{ route('admin.courses.approved', $course) }}" class="mt-4" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full">
                                    Aprobar como curso publico
                                </button>
                            </form>
                        </div>
                        <div>
                            <div class="flex ">
                                <div x-data="{ dropdownOpen: false }" class="absolute">
                                    <button @click="dropdownOpen = !dropdownOpen" class="relative btn btn-primary mt-4 z-10 block rounded-md bg-white p-2 focus:outline-none">
                                        <svg class="h-6 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    
                                    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                                    
                                    <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                                        <a class="block px-1 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">
                                            <form action="{{ route('admin.courses.private_course', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="">
                                                    Aprobar como curso privado
                                                </button>
                                            </form>
                                        </a>
                                        <a href="{{ route('courses.status',$course) }}" class="block px-1 py-2 text-sm capitalize text-gray-700 hover:bg-green-500 hover:text-white">
                                            Revisar curso
                                        </a>
                                        <a href="{{ route('admin.courses.observation', $course) }}" class="block px-1 py-2 text-sm capitalize text-gray-700 hover:bg-red-500 hover:text-white">
                                            Observar curso
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <a href="{{ route('admin.courses.observation', $course) }}" class="btn btn-danger w-full block text-center mt-4">Observar curso</a> --}}

                    {{-- <form action="{{ route('admin.courses.private_course', $course) }}" class="mt-4" method="POST">
                        @csrf

                        <button type="submit" class="btn bg-yellow-300 w-full block">
                            Aprobar como curso privado
                        </button>
                        
                    </form> --}}
                </div>

                {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
                {{-- <div class="flex justify-center">
                    <div x-data="{ dropdownOpen: false }" class="relative my-32">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative btn btn-primary z-10 block rounded-md bg-white p-2 focus:outline-none">
                            <svg class="h-6 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                        
                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                your profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Your projects
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Help
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Settings
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div> --}}
                
            </section>
        </div>
    </div>
</x-app-layout>