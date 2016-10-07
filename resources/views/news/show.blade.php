@extends('layouts.app')

@section('title', $item->title)

@section('content')
    <div><a href="{{ route('news') }}"><i class="fa fa-chevron-left"></i> все новости</a></div>
    <h1>{{ $item->title }}</h1>
    {!! $item->text !!}
    <div class="news-date"><i class="fa fa-clock-o"></i> {{ $item->published_at }}</div>
@endsection