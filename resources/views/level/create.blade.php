@extends('layouts.app')
{{-- customize layout settings --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')
{{-- content body --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Level Baru</h3>
            </div>

            <form action="../level" method="post">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeLevelKategori">Kode Level</label>
                        <input type="text" class="form-control" id="kodeLevel" name="kodeLevel" placeholder="Kode Level">
                    </div>
                    <div class="form-group">
                        <label for="namaLevel">Nama Level</label>
                        <input type="text" class="form-control" id="namaLevel" name="namaLevel" placeholder="Nama Level">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    
    @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada masalah dengan inputan anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
@endsection