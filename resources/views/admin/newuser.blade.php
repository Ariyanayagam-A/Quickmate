@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

<form action="{{route('import-excel')}}" method="POST" enctype="multipart/form-data">
    @csrf  <!-- Add this -->
    <input type="file" name="file">
    <button type="submit">Upload</button>
  </form>

  <h2>User Registration</h2>
  <form action="{{ route('user.create') }}" method="POST">
      @csrf
      <label for="username">Username:</label>
      <input type="text" name="username" required><br><br>

      <label for="fname">Firstname :</label>
      <input type="text" name="fname" required><br><br>

      <label for="lname">Lastname :</label>
      <input type="text" name="lname" required><br><br>

      <label for="email">Email:</label>
      <input type="text" name="email" required><br><br>

      <label for="password">Password:</label>
      <input type="password" name="password" required><br><br>

      <!-- <label for="role">Role:</label>
      <select name="role" required>
          <option value="user">User</option>
          <option value="support team">Support Team</option>
          <option value="engineer">Engineer</option>
      </select><br><br> -->

      <button type="submit">Register</button>
  </form>

@endsection