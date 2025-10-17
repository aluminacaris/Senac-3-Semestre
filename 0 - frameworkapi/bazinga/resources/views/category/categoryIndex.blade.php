@extends('layout')
@section('content')
<table class="table table-dark table-striped">
   <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
      <th scope="col">Editar</th>
      <th scope="col">Mostrar</th>
    </tr>
    <tbody>
        @foreach($categories as $cat)
    <tr>
      <th scope="row">{{$cat->id}}</th>
      <td>{{$cat->name}}</td>
      <td>{{$cat->description}}</td>
      <td><a href="{{route('category.edit', $cat->id)}}"><button type="button" class="btn btn-success" hres>Editar</button></td>
      <td><a href="{{route('category.show', $cat->id)}}"><button type="button" class="btn btn-success" hres>Mostrar</button></td>
    </tr>
    @endforeach
    </tbody>
  </thead>
</table>
@endsection