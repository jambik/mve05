@extends('layouts.app')

@section('title', $page->title)

@section('content')
    @include('partials._status')
    @include('partials._errors')
@endsection