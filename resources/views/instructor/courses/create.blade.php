<x-app-layout>
    <div class="container py-8">
        <div class="card">
            <div class="card-body">
                <h1 class="font-bold text-2xl">CREAR NUEVO CURSO</h1>
                <hr class="mt-2 mb-6">
                {!! Form::open(['route' => 'instructor.courses.store', 'files'=> true, 'autocomplete' => 'off']) !!}
                    
                    {!! Form::hidden('user_id', auth()->user()->id) !!}
                    
                    @include('instructor.courses.partials.form')
                
                    <div class="flex justify-end">
                        {!! Form::submit('Crear nuevo curso',['class' => 'btn btn-primary cursor-pointer']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <x-slot name="js">
        {{-- Texto enrriquesido ckeditor.com --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
        <script src="{{ asset('js/instructor/courses/form.js') }}"></script>
    </x-slot>   
</x-app-layout>