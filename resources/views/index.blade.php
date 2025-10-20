@extends('layouts.app')

@section('content')
  @include('sections.hero')
  @include('sections.features')
  @include('sections.about')
  @include('sections.cta')
@endsection

@section('footer')
  @include('sections.footer')
@endsection
