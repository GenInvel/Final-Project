@extends('admin.layouts.dashboard')

@section('title', 'Manage Staff - TheSPARK Admin')
@section('page-title', 'Staff Management')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/staff.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="staff-management">
    <!-- View Toggle -->
    <div class="view-toggle">
        <a href="{{ route('admin.staff.index', ['view' => 'active']) }}" 
           class="toggle-btn {{ $view === 'active' ? 'active' : '' }}">
            Active Staff
        </a>
        <a href="{{ route('admin.staff.index', ['view' => 'archived']) }}" 
           class="toggle-btn {{ $view === 'archived' ? 'active' : '' }}">
            Archived Staff
        </a>
    </div>

    @if($staff->count() > 0)
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>CSPC Email</th>
                    <th>Position</th>
                    <th>Program</th>
                    <th>Year/Section</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $member)
                <tr>
                    <td>
                        <div class="staff-member">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="staff-avatar">
                            <span class="staff-name">{{ $member->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="staff-email">{{ $member->email }}</span>
                    </td>
                    <td>
                        <span class="position-badge {{ strtolower(str_replace([' ', '&'], ['-', 'and'], $member->position)) }}">
                            {{ $member->position }}
                        </span>
                    </td>
                    <td>{{ $member->program }}</td>
                    <td>{{ $member->year_section }}</td>
                    <td>
                        <div class="action-buttons">
                            @if($view === 'active')
                                <a href="{{ route('admin.staff.edit', $member->id) }}" class="action-btn edit-btn" title="Edit">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                
                                <form action="{{ route('admin.staff.archive', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to archive this staff member?');">
                                    @csrf
                                    <button type="submit" class="action-btn archive-btn" title="Archive">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="21 8 21 21 3 21 3 8"/>
                                            <rect x="1" y="3" width="22" height="5"/>
                                            <line x1="10" y1="12" x2="14" y2="12"/>
                                        </svg>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.staff.destroy', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete this staff member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn remove-btn" title="Delete">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            <line x1="10" y1="11" x2="10" y2="17"/>
                                            <line x1="14" y1="11" x2="14" y2="17"/>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.staff.unarchive', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to restore this staff member?');">
                                    @csrf
                                    <button type="submit" class="action-btn restore-btn" title="Restore">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="23 4 23 10 17 10"/>
                                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                                        </svg>
                                        Restore
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <p>No {{ $view }} staff members found.</p>
        </div>
    @endif
</div>
@endsection
