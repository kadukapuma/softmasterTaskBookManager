@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Generate Book Report</h2>

  <form action="{{ route('reports.generate') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label>From Date</label>
      <input type="date" name="from" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>To Date</label>
      <input type="date" name="to" class="form-control" required>
    </div>
    <button class="btn btn-primary">Generate PDF</button>
  </form>
</div>
@endsection
