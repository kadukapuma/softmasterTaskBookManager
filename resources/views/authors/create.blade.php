@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">{{ isset($author) ? 'Edit Author' : 'Add Author' }}</h2>

  <form method="POST" action="{{ isset($author) ? route('authors.update', $author) : route('authors.store') }}">
    @csrf
    @if(isset($author)) @method('PUT') @endif

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" class="form-control" value="{{ old('name', $author->name ?? '') }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Biography</label>
      <textarea name="biography" class="form-control">{{ old('biography', $author->biography ?? '') }}</textarea>
    </div>
    <button class="btn btn-success">{{ isset($author) ? 'Update' : 'Save' }}</button>
  </form>
</div>
@endsection
