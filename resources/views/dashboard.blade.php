@extends('layout')

@section('title', 'Dashboard')

@section('content')
<h4>Hi there, {{session('user-token')->name}} 👋</h4>
<h1>Students Record</h1>
<div class="d-flex align-items-center justify-content-between mb-3">
  <a class="btn btn-primary" href="/add-student">Add Student</a>
  <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a></div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Student ID</th>
        <th scope="col">Enrolled Course</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        
        @foreach ($students as $student)
        <tr>
            <th scope="row">{{$student->id}}</th>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->student_id}}</td>
            <td>{{$student->enrolled_course}}</td>
<td>
  <a class="text-primary" href="{{"/view-student/".$student->id}}">View</a> |
  <a class="text-warning" href="{{"/edit-student/".$student->id}}">Edit</a>
  |
  <a class="text-danger" href="{{"/delete-student/".$student->id}}">Delete</a>
   </td>
            <td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection