@extends('layouts.app', ['title' => 'Contact'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="section-card p-4 p-lg-5">
            <p class="text-uppercase small text-muted mb-2">Logged-in support form</p>
            <h1 class="display-font mb-3">Contact the store team</h1>
            <p class="text-muted">This form is only available to authenticated customers, matching your requirement for gated customer support.</p>
            <form method="POST" action="{{ route('contact.store') }}" class="row g-3 mt-1">
                @csrf
                <div class="col-12">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="7" class="form-control" required>{{ old('message') }}</textarea>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-brand btn-lg">Send message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
