@extends('layouts.layout')

@section('title','Usuarios')

@section('content')

<div class="container">

        <div class="d-flex justify-content-between align-items-end">
            <h2 class="display-4">{{$title}}</h2>
            <p>
              @if ( $view === 'index')
                @auth
                <a href="{{route('users.trashed')}}" 
                        class="btn btn-outline-primary btn-sm">Papelera Usuarios</a>
                <a href="{{route('users.create')}}" class="btn btn-primary btn-sm">Nuevo Usuario</a>
                @endauth
              @else
                <a href="{{route('users.index')}}" 
                        class="btn btn-outline-primary btn-sm">Regresar al Listado</a>   
              @endif
            </p>
        </div>

        <div class="card" >
            <div class="card-body table-responsive">

                {{-- Buscador --}}
                @if ( $view === 'index')
                    <form method="GET" action="{{route('users.index')}}" class="py-1">
                @else
                    <form method="GET" action="{{route('users.trashed')}}" class="py-1">  
                @endif
                    <div class="row row-filters">
                        {{-- Buscador de barra --}}
                        <div class="col-md-6">
                            <div class="form-inline form-search ">
                                <div class="input-group">
                                    <input type="search" name="search" value="{{request('search')}}" class="form-control form-control-sm" placeholder="Buscar...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary btn-sm"><span><i class="fas fa-search"></i></span></button>
                                    </div>
                                </div>
                                &nbsp;
                            </div>
                        </div>
                         {{-- Buscador por Fechas --}}
                        <div class="col-md-6 text-right">
                            <div class="form-inline form-dates">
                                <label for="from" class="form-label-sm">Fecha</label>&nbsp;
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="from" id="from" placeholder="Desde" value="{{ request('from') }}">
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="to" id="to" placeholder="Hasta" value="{{ request('to') }}">
                                </div>
                                &nbsp;
                                <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </div>
                    </form>

                @if ($users->isNotEmpty())

                <p class="container d-flex justify-content-center">Consulta en la página 
                    {{$users->currentpage()}} de {{$users->lastpage()}}</p>

                    <div class="table-responsive-lg table table-hover table-striped">
                        <table class="table table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#Id </th>
                                <th scope="col">
                                    <a href="{{$sortable ->url('name')}}" class="{{$sortable->classes('name')}}">Usuarios
                                        <i class="icon-sort"></i>
                                    </a></th>
                                <th scope="col">
                                    <a href="{{$sortable ->url('email')}}" class="{{$sortable->classes('email')}}">Emails 
                                        <i class="icon-sort"></i>
                                    </a></th>
                                <th scope="col">
                                    <a href="{{$sortable ->url('role')}}" class="{{$sortable->classes('role')}}">Roles 
                                        <i class="icon-sort"></i>
                                    </a></th>
                                <th scope="col">
                                    <a href="{{$sortable ->url('created_at')}}" class="{{$sortable->classes('created_at')}}">Fecha de Creacion 
                                        <i class="icon-sort"></i>
                                    </a></th>
                                <th scope="col" class="text-right th-actions">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user -> id}}</td>
                                        <td>{{$user->name}}
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <th>
                                            {{ $user->permissions}}
                                        </th>
                                        <td> <span class="note">{{ $user->created_at->format('d/m/Y') }}</span>
                                        </td>

                                        <td class="text-right">
                                            @if ($user->trashed())
                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{route('users.restore',$user->id)}}" class="btn btn-outline-secondary btn-sm"><span><i class="fas fa-recycle"></i></span></a> 
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <span><i class="fas fa-times-circle fa"></i></span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.trash', $user) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary btn-sm"><span><i class="fas fa-eye"></i></span></a>
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm"><span><i class="fas fa-edit"></i></span></a>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span></button>
                                                </form>
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No hay Usuarios registrados.</p>
                @endif

            </div>
        </div>

<div class="container d-flex justify-content-center">
    {{ $users -> appends(request(['search']))-> links() }}
</div>

</div>

@endsection