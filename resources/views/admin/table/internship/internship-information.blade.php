@php
    $program = \App\Models\Program::find(request()->route('internship_program'));
@endphp

@if($program)
    <div class="program-details">
        <h2>{{ $program->position }}</h2>
        <p><strong>Supervisor:</strong> {{ $program->supervisor }}</p>
        <p><strong>Active Applicants:</strong> {{ $program->active_applicants }}</p>
        <p><strong>All Applicants:</strong> {{ $program->all_applicants }}</p>
        <p><strong>Status:</strong> 
            <span class="{{ $program->status == 'active' ? 'status-approved' : 'status-rejected' }}">
                {{ $program->status }}
            </span>
        </p>
        <p><strong>Created on:</strong> {{ $program->created_at->format('Y-m-d') }}</p>
    </div>
@else
    <p>Internship program information not available.</p>
@endif