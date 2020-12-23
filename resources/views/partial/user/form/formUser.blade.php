@csrf

<h1 class="display-5"> Datos Generales</h1>

{{-- Nombre y Correo --}}
<div class="row mx-auto py-1">
    <div class="col-6 col-md-6">
      <label for="name">Nombre<span class="star">*</span>:</label>
      <input type="text" class="form-control text-center form-control-sm
              @error('name') is-invalid
              @enderror"
              name="name" id="name"
              value="{{old('name',$user->name)}}"
              autocomplete="name" autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
              @enderror
    </div>

    <div class="col-6 col-md-6">
      <label for="email">Correo Electronico<span class="star">*</span>:</label>
      <input type="email" class="form-control text-center form-control-sm
              @error('email') is-invalid
              @enderror"
              name="email" id="email"
              value="{{old('email',$user->email)}}"
              autocomplete="email">

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
              @enderror
    </div>
</div>

{{-- Password y Confirmacion de Password--}}
<div class="row mx-auto py-1">
    <div class="col-6 col-md-6">
      <label for="password">Contraseña<span class="star">*</span>:</label>
      <input type="password" class="form-control text-center form-control-sm
              @error('password') is-invalid
              @enderror"
              name="password" id="password"
              autocomplete="new-password" >

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
              @enderror
    </div>

    <div class="col-6 col-md-6">
      <label for="password-confirm">Confirmar Contraseña<span class="star">*</span>:</label>
      <input type="password" class="form-control text-center form-control-sm
              @error('password-confirm') is-invalid
              @enderror"
              name="password-confirm" id="password-confirm"
              autocomplete="new-password">

              @error('password-confirm')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
              @enderror
    </div>
</div>

<hr> {{-- Separador --}}

{{-- Botones --}}

@include('partial.funcional.ButtonstoForms')