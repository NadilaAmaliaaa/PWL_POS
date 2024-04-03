@extends ('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage User</div>
            <div css="card-body">
                {{ $dataTable->table() }}
                <a href="/user/create" class="btn btn-outline-primary btn-block" role="button" aria-disabled="true">Tambah User</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts()}}
@endpush