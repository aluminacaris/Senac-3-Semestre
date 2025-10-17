@extends('layout')
@section('content')
<table class="table table-dark table-striped">
   <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Titulo</th>
      <th scope="col">Descrição</th>
      <th scope="col">Pontos</th>
      <th scope="col">Categoria</th>
      <th scope="col">Editar</th>
      <th scope="col">Mostrar</th>
    </tr>
    <tbody>
        @foreach($actions as $at)
    <tr>
      <th scope="row">{{$at->id}}</th>
      <td>{{$at->title}}</td>
      <td>{{$at->description}}</td>
      <td>{{$at->points}}</td>
      <td>{{$at->categories->name}}</td>
      <td><a href="{{--route('category.edit', $cat->id)--}}"><button type="button" class="btn btn-success" hres>Editar</button></td>
      <td><a href="{{--route('category.show', $cat->id)--}}"><button type="button" class="btn btn-success" hres>Mostrar</button></td>
    </tr>
    @endforeach
    </tbody>
  </thead>
</table>
@endsection