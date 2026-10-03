@extends('layouts.app')

@section('content')
    <h1>{{ $activity->title }}</h1>
    @error('status')
    <div style="background: #ffdddd; color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        {{ $message }}
    </div>
    @enderror

    @if($activity->poster)
    <div style="margin-bottom: 15px;">
        <img src="{{ asset('storage/' . $activity->poster) }}" alt="Poster Kegiatan" width="300" style="border: 1px solid #ccc;">
    </div>
    @endif
    
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><strong>Tanggal:</strong> {{ $activity->activity_date->format('d M Y') }}</p>
    <p><strong>Kategori:</strong> {{ $activity->category->name }}</p>
    <p><strong>Status:</strong> {{ $activity->status }}</p>
    
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $activity->description }}</p>

    <a href="{{ route('activities.edit', $activity) }}">Edit</a>
    
    @if ($activity->status === 'draft')
    <form action="{{ route('activities.publish', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" onclick="return confirm('Yakin ingin mempublikasikan kegiatan ini?')">Publish</button>
    </form>
    @endif

    @if ($activity->status === 'published')
    <form action="{{ route('activities.complete', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" onclick="return confirm('Yakin ingin menyelesaikan kegiatan ini?')">Complete</button>
    </form>
    @endif

    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
    </form>

    <br><br>
    <a href="{{ route('activities.index') }}">Kembali ke Daftar</a>
@endsection