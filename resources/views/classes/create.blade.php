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
      <div class="col-md-6 mb-3">

         <label class="form-label">Subjects</label>

         <div class="subject-selector">

            {{-- Search --}}
            <input
               type="text"
               id="subjectSearch"
               class="form-control mb-2"
               placeholder="Search subjects...">

            {{-- Subjects --}}
            <div
               id="subjectList"
               class="border rounded p-4"
               style="max-height: 250px; overflow-y: auto;">

               @foreach ($subjects as $subject)

               <div class="form-check subject-item">

                  <input
                     type="checkbox"
                     name="subjects[]"
                     value="{{ $subject->id }}"
                     class="form-check-input subject-checkbox"
                     id="subject{{ $subject->id }}"

                     {{ $class->subjects->contains($subject->id) ? 'checked' : '' }}>

                  <label
                     class="form-check-label"
                     for="subject{{ $subject->id }}">

                     {{ $subject->name }} - {{ $subject->code }}

                  </label>

               </div>

               @endforeach

            </div>

         </div>

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