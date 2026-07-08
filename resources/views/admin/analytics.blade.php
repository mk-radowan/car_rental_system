@extends('layouts.admin')
@section('title', 'Analytics')
@section('page-title', 'Analytics')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="glass-card stat-card warning text-center">
            <i class="bi bi-hourglass-split" style="font-size:2rem;color:#f59e0b;margin-bottom:10px;display:block"></i>
            <div class="stat-value">{{ $bookingsByStatus['pending'] }}</div>
            <div class="stat-label">Pending Bookings</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card stat-card success text-center">
            <i class="bi bi-check-circle" style="font-size:2rem;color:#10b981;margin-bottom:10px;display:block"></i>
            <div class="stat-value">{{ $bookingsByStatus['approved'] }}</div>
            <div class="stat-label">Approved Bookings</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card stat-card danger text-center">
            <i class="bi bi-x-circle" style="font-size:2rem;color:#e8192c;margin-bottom:10px;display:block"></i>
            <div class="stat-value">{{ $bookingsByStatus['rejected'] }}</div>
            <div class="stat-label">Rejected Bookings</div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-6">
        <div class="glass-card p-4">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                <i class="bi bi-tags me-2" style="color:#e8192c"></i>Cars by Category
            </h5>
            @foreach($categoryStats as $cat => $count)
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span style="color:#374151;font-size:0.88rem">{{ $cat }}</span>
                <strong style="color:#1a1a2e">{{ $count }}</strong>
            </div>
            <div class="progress mb-3" style="height:6px;border-radius:4px;background:#f3f4f6">
                <div class="progress-bar" style="width:{{ ($count/max(array_values($categoryStats)))*100 }}%;background:#e8192c;border-radius:4px"></div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="glass-card p-4">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                <i class="bi bi-geo-alt me-2" style="color:#e8192c"></i>Cars by City
            </h5>
            @foreach($cityStats as $city => $count)
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span style="color:#374151;font-size:0.88rem">{{ $city }}</span>
                <strong style="color:#1a1a2e">{{ $count }}</strong>
            </div>
            <div class="progress mb-3" style="height:6px;border-radius:4px;background:#f3f4f6">
                <div class="progress-bar" style="width:{{ ($count/max(array_values($cityStats)))*100 }}%;background:#3b82f6;border-radius:4px"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
