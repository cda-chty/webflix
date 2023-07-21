@extends('layouts.app')

@section('content')
    @foreach ($cart as $item)
        {{ $item }}
    @endforeach
@endsection
