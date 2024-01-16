@extends('layout')

@section('title', 'Edit Student')

@section('content')
<form
style="width:400px; margin:0 auto;"
method="POST"
action="{{ url('/handle-edit-student/' . $student->id) }}">
{{-- action="handle-add-student"> --}}
<h1>Edit Student - {{$student->id}}</h1>
        @csrf()
        @method('PUT')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('name', $student->name)}}" name="name" required>
          @error('name') <span style="color:red;">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email', $student->email)}}" name="email" required>
          @error('email') <span style="color:red;">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Student ID</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('student_id', $student->student_id)}}" name="student_id" required>
          @error('student_id') <span style="color:red;">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Course</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('enrolled_course', $student->enrolled_course)}}" name="enrolled_course" required>
            @error('enrolled_course') <span style="color:red;">{{$message}}</span>@enderror
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>

      @endsection