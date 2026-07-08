@extends('layouts.admin')
@section('title', 'Manage Users')
@section('page-title', 'Manage Users')
@section('content')
<div class="glass-card" style="overflow:hidden">
    <div style="padding:20px 24px;border-bottom:1px solid #f3f4f6">
        <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
            <i class="bi bi-people me-2" style="color:#e8192c"></i>All Users
        </h5>
    </div>
    <div class="table-responsive admin-table">
        <table class="table table-hover mb-0">
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Registered</th></tr></thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;background:{{ $user->role==='admin'?'#e8192c':'#3b82f6' }};border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.8rem;flex-shrink:0">
                                {{ substr($user->name,0,1) }}
                            </div>
                            <strong style="color:#1a1a2e">{{ $user->name }}</strong>
                        </div>
                    </td>
                    <td style="color:#374151">{{ $user->email }}</td>
                    <td style="color:#374151">{{ $user->phone }}</td>
                    <td>
                        <span style="background:{{ $user->role==='admin'?'#fee2e2':'#eff6ff' }};color:{{ $user->role==='admin'?'#991b1b':'#1d4ed8' }};padding:3px 12px;border-radius:20px;font-size:0.78rem;font-weight:700">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td style="color:#6c757d;font-size:0.85rem">{{ $user->created_at?->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
