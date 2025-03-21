@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{route('import-excel')}}" method="POST" enctype="multipart/form-data">
    @csrf  <!-- Add this -->
    <input type="file" name="file">
    <button type="submit">Upload</button>
  </form>
@endsection