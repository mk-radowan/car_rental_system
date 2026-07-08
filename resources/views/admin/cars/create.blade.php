@extends('layouts.admin')
@section('title', 'Add Car')
@section('page-title', 'Add New Car')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="glass-card p-4" style="border-top:4px solid #e8192c">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:24px">
                <i class="bi bi-plus-circle me-2" style="color:#e8192c"></i>Add New Car to Fleet
            </h5>
            <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.cars._form')
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Save Car
                    </button>
                    <a href="{{ route('admin.cars') }}" class="btn btn-outline-red">
                        <i class="bi bi-arrow-left me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
