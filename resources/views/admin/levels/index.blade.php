@extends('adminlte::page')

@section('title', 'Coders Free')

@section('content_header')
    <a href="{{ route('admin.levels.create') }}" class="btn btn-secondary float-right">Crear nivel</a>
    <h1>Lista de niveles</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levels as $level)
                        <tr>
                            <td>{{ $level->id }}</td>
                            <td>{{ $level->name }}</td>
                            <td width="10">
                                <a href="{{ route('admin.levels.edit', $level) }}" class="btn btn-primary">Editar</a>
                            </td>
                            <td width="10">
                                <form action="{{ route('admin.levels.destroy', $level) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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