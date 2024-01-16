@extends('layout')

@section('title', 'Add Student')

@section('content')
<form
style="width:400px; margin:0 auto;"
method="POST"
action="handle-add-student">
<h1>Add Student</h1>
        @csrf()
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('name')}}" name="name" required>
          @error('name') <span style="color:red;">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}" name="email" required>
          @error('email') <span style="color:red;">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Student ID</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('student_id')}}" name="student_id" required>
          @error('student_id') <span style="color:red;">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Course</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('enrolled_course')}}" name="enrolled_course" required>
            @error('enrolled_course') <span style="color:red;">{{$message}}</span>@enderror
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      @endsection