@extends('layouts.layout')

@section('title','Nuevo Usuario')

@section('content')

  <div class="d-flex justify-content-center">
    <h1 class="display-4">@lang('Nuevo Usuario')</h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 mx-auto">

        <form method="POST" action="{{route('users.store')}}"
        class="shadow rounded text-center " 
        enctype="multipart/form-data"
        validate>

          {{-- Formulario Hoja de Vida --}}

          @include('partial.user.form.formUser',['btnText'=>'Crear'])

        </form>

      </div>
    </div>
  </div>
@endsection