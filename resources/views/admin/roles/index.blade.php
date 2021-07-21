@extends('adminlte::page')

@section('title', 'Coders Free')

@section('content_header')
    <h1>Lista de roles</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>{{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-head my-2 mx-2">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Crear rol</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cont = 1; ?>
                    @forelse ($roles as $role)
                        <tr>
                            {{-- <td>{{ $role->id }}</td> --}}
                            <td width="15">{{ $cont }}</td>
                            <td>{{ $role->name }}</td>
                            <td width="10">
                                <a href="{{ route('admin.roles.edit',$role) }}" class="btn btn-secondary">Editar</a>
                            </td>
                            <td width="10">
                                <form action="{{ route('admin.roles.destroy',$role) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php $cont++; ?>
                    @empty
                        <tr>
                            <td colspan="4">No hay ningun rol registrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop