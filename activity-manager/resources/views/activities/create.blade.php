@extends('layouts.app')

@section('content')
    <h1>Tambah Kegiatan</h1>
    @if ($errors->any())
    <div style="background: #ffdddd; color: red; padding: 10px; margin-bottom: 15px; border: 1px solid red;">
        <b>Oops, ada yang salah:</b>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('activities._form')

        <div style="margin-bottom: 15px;">
            <label>Upload Poster (JPG/PNG, Max 2MB):</label>
            <br>
            <input type="file" name="poster" accept="image/png, image/jpeg">
        </div>

        <button type="submit">Simpan</button>
    </form>
    
    <a href="{{ route('activities.index') }}">Batal</a>
@endsection