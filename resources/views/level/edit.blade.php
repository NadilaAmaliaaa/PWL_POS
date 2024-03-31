@extends('layouts.app')
{{-- customize layout settings --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Edit')
{{-- content body --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ubah Level</h3>
            </div>

            <form action="{{ url('level/ubah_simpan', $level->level_id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Level Kode</label>
                        <input type="text" class="form-control" id="levelKode" name="levelKode"  value="{{ $level->level_kode }}">
                    </div>
                    <div class="form-group">
                        <label for="">Level Nama</label>
                        <input type="text" class="form-control" id="levelNama" name="levelNama"  value="{{ $level->level_nama }}">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection