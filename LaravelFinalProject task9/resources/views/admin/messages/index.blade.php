@extends('layouts.admin', ['title' => 'Contact Messages'])

@section('content')
<div class="card card-clean">
    <div class="card-body">
        <h2 class="h4 mb-4">Customer Contact Messages</h2>
        <div class="row g-3">
            @foreach($messages as $message)
                <div class="col-12">
                    <div class="border rounded-4 p-4">
                        <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                            <div>
                                <div class="fw-semibold">{{ $message->subject }}</div>
                                <div class="small text-muted">{{ $message->user->name }} | {{ $message->user->email }}</div>
                            </div>
                            <div class="small text-muted">{{ $message->created_at->format('d M Y, h:i A') }}</div>
                        </div>
                        <p class="mb-0">{{ $message->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $messages->links() }}</div>
    </div>
</div>
@endsection
