@php
    $applicant = \App\Models\Applicant::find(request()->route('applicant'));
@endphp

@if($applicant)
    <div class="applicant-details">
        <h2>{{ $applicant->first_name }} {{ $applicant->last_name }}</h2>
        <p><strong>Email:</strong> {{ $applicant->email }}</p>
        <p><strong>Phone:</strong> {{ $applicant->phone }}</p>
        <p><strong>Position:</strong> {{ $applicant->position }}</p>
        <p><strong>Status:</strong> {{ $applicant->status }}</p>
        <p><strong>Applied on:</strong> {{ $applicant->created_at->format('Y-m-d') }}</p>
    </div>
@else
    <p>Applicant information not available.</p>
@endif
