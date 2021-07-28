@extends('adminlte::page')

@section('title', 'Coders Free')

@section('content_header')
    <h1>Cursos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>    
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cursos</th>
                        <th>Estudiantes Matriculados</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $cont = 1; ?>
                    @foreach ($courses as $course)
                        <tr>
                            <td><?= $cont ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="flexbox">
                                        <figure class="mr-2">
                                            <img class="img-circle" height="50px" width="50px" src="{{ Storage::url($course->image->url) }}" alt="">
                                        </figure>
                                    </div>
                                    <div>
                                        {{ $course->title }}<span class="text-secundary"></span><br>
                                        <span class="small">
                                            <strong>Prof.:</strong> {{ $course->teacher->name }} <br>
                                            <strong>Categoria: </strong>{{ $course->category->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <i class="fas fa-fw fa-users mr-2"></i> {{ $course->students->count() }}
                                <div class="">
                                    <span class="small"><strong>Calificación</strong></span>
                                    <ul class="list-group list-group-horizontal text-center">
                                        {{-- <li class="mr-3" style="list-style: none;"> 
                                            {{ (int)$course->rating }}
                                        </li> --}}
                                        <li style="list-style: none;">
                                            <i class="fas fa-star text-{{ $course->rating >=1 ? 'warning':'muted' }}"></i>
                                        </li>
                                        <li style="list-style: none;">
                                            <i class="fas fa-star text-{{ $course->rating >=2 ? 'warning':'muted' }}"></i>
                                        </li>
                                        <li style="list-style: none;">
                                            <i class="fas fa-star text-{{ $course->rating >=3 ? 'warning':'muted' }}"></i>
                                        </li>
                                        <li style="list-style: none;">
                                            <i class="fas fa-star text-{{ $course->rating >=4 ? 'warning':'muted' }}"></i>
                                        </li>
                                        <li style="list-style: none;">
                                            <i class="fas fa-star text-{{ $course->rating ==5 ? 'warning':'muted' }}"></i>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="" class="btn btn-success">Matricular</a>
                            </td>
                        </tr>
                        <?php $cont++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $courses->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop