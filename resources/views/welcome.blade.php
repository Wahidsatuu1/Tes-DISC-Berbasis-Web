@extends('layouts.guest')

@section('title', __('messages.register_and_follow_test') . ' | EQUITYWORLD FUTURES')

@push('styles')
<style>
    .hover-card-wrapper {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: block;
    }
    .hover-card-wrapper:hover {
        transform: translateY(-8px);
    }
    .hover-card-wrapper:hover .clickable-card {
        box-shadow: 0 15px 30px rgba(253, 126, 20, 0.15) !important;
        border-color: rgba(253, 126, 20, 0.4) !important;
    }
    .text-orange-gradient {
        color: #fd7e14;
        transition: color 0.3s ease;
    }
    .hover-card-wrapper:hover .text-orange-gradient {
        color: #e8590c;
    }
    .arrow-icon {
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }
    .hover-card-wrapper:hover .arrow-icon {
        transform: translateX(6px);
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="col-md-8 col-lg-7 text-center">
        <a href="{{ route('psikotes.index') }}" class="hover-card-wrapper text-decoration-none">
            <div class="card shadow-sm p-4 border border-secondary border-opacity-25 clickable-card" style="border-radius: 12px; border-top: 4px solid #fd7e14 !important; background-color: var(--bs-body-bg);">
                <div class="card-body py-4">
                    <span class="fw-bold fs-2 text-orange-gradient d-inline-flex align-items-center justify-content-center flex-wrap">
                        {{ __('messages.register_and_follow_test') }}
                        <i class="fas fa-chevron-right ms-3 arrow-icon"></i>
                    </span>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
