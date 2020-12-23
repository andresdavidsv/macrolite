@extends('layouts.layout')

@section('title','Usuario: '.$user->id)

@section('content')

<h2>Usuario #{{$user->id}}</h2>

<p>Nombre del Usuario:{{$user->name}}</p>

<a href="{{route('users.index')}}"> Regreso </a>

@endsection