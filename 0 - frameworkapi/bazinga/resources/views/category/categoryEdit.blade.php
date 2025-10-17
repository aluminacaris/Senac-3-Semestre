@extends('layout')
@section('content')
@if(session()->has('message'))
    {{session()->get('message')}}
@endif
<form action="{{route('category.update', $category->id)}}" method="POST">
@csrf
@method('PUT')
    <legend>Editar Categoria</legend>
    <div class="mb-3">
        <label for="disableTextInput" class="form-label">Nome</label>
        <input type="text" id="disableTextInput" name="name" class="form-control" value="{{$category->name}}">
    </div>
     <div class="mb-3">
        <label for="disableTextInput" class="form-label">Descrição</label>
        <input type="text" id="disableTextInput" name="description" class="form-control" value="{{$category->description}}">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
   
    </form>
    @endsection