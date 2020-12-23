@extends('layouts.layout')

@section('title',' Editando Usuario')

@section('content')

<div class="d-flex justify-content-center">
    <h1 class="display-4">@lang('Editar Usuario')</h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 mx-auto">

        <form method="POST" action="{{route('users.update',$user->id)}}"
        class="shadow rounded text-center"
        enctype="multipart/form-data">
        @method('PATCH')

          {{-- Formulario Hoja de Vida --}}

          {{-- Fotografia Usuario --}}

          @include('partial.user.form.formUser',['btnText'=>'Editar'])

        </form>

      </div>
    </div>
  </div>

@endsection