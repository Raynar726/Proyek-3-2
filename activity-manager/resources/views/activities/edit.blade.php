@extends('layouts.app')

@section('content')
    <h1>Ubah Kegiatan</h1>
    
    <form action="{{ route('activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    @if($activity->poster)
        <div style="margin-bottom: 10px;">
            <img src="{{ asset('storage/' . $activity->poster) }}" alt="Poster" width="150">
        </div>
    @endif

    <label>Upload Poster (JPG/PNG, Max 2MB):</label>
    <input type="file" name="poster" accept="image/png, image/jpeg">
        
        <button type="submit">Simpan Perubahan</button>
    </form>
    
    <a href="{{ route('activities.show', $activity) }}">Batal</a>
@endsection