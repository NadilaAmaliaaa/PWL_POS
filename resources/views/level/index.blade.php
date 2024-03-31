@extends ('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Level')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Level')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Level</div>
            <div css="card-body">
                {{ $dataTable->table() }}
                <a href="/level/create" class="btn btn-outline-primary btn-block" role="button" aria-disabled="true">Tambah Level</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts()}}
@endpush