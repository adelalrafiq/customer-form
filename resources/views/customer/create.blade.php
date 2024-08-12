@extends('layouts.app')

@section('title', 'Klantenformulier')
    
@section('content')
<h2>Klantenformulier</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="/form" method="POST" enctype="multipart/form-data" id="customer-form">
@csrf
<div class="form-group">
    <label for="name">Naam<span class="required">*</span></label></label>
    <input type="text" class="form-control" id="name" name="name" required>
</div>
<div class="form-group">
    <label for="email">Email<span class="required">*</span></label></label>
    <input type="email" class="form-control" id="email" name="email" required>
</div>
<div class="form-group">
    <label for="ticket">Ticket<span class="required">*</span></label></label>
    <div class="dropzone" id="ticket-dropzone">
    <div class="dz-message">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Sleep bestanden hierheen of klik om te uploaden.</span>
        </div>
    </div>
</div>
<div class="container-fluid full-height d-flex justify-content-center align-items-center">
<button type="submit"  class="btn fab-extended" id="submit-all">Verzenden</button>
</div>
</form>
@endsection