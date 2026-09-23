@extends('layouts.app')
@section('title','Add Class')
@section('content')
<div class="container-fluid mt-4 px-4">
   <h1 class="mb-4">Add Class</h1>
   <form action="/classes" method="POST">
      @csrf
      <!-- Class Name  -->
      <div class="mb-3">
         <label for="" class="form-label">Class Name</label>
         <input type="text" name="name"
            class="form-control">
      </div>
      <!-- Section  -->
      <div class="mb-3">
         <label for="" class="form-label">Section</label>
         <input type="text" name="section" class="form-control">
      </div>
      <!-- Subject  -->
      <div class="mb-3">

         <label class="form-label">Subjects</label>

         <select
            name="subjects[]"
            class="form-select"
            multiple>

            @foreach ($subjects as $subject)

            <option value="{{ $subject->id }}">
               {{ $subject->name }} - {{ $subject->code }}
            </option>

            @endforeach

         </select>

         <small class="text-muted">
            Hold Ctrl to select multiple subjects.
         </small>

      </div>
      <!-- Description -->
      <label for="" class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3"></textarea>

      <!-- Button  -->
      <button type="submit" class="btn btn-primary-action">
         <i class="bi bi-save me-1"></i>
         Save Class
      </button>
      <a href="/classes" class="btn btn-secondary">Cancel</a>
   </form>
</div>

@endsection