@extends('layouts.app')

@section('content')
  <h1>{{$album->name}}</h1>
  <a class="button secondary" href="/">Go Back</a>
  <a class="button" href="/photoshow/public/photos/create/{{$album->id}}">Upload Photo to Album</a>
  <hr>
@endsection
