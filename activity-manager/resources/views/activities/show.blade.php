@extends('layouts.app')

@section('content')
    <h1>{{ $activity->title }}</h1>
    
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><strong>Tanggal:</strong> {{ $activity->activity_date->format('d M Y') }}</p>
    <p><strong>Kategori:</strong> {{ $activity->category->name }}</p>
    <p><strong>Status:</strong> {{ $activity->status }}</p>
    
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $activity->description }}</p>

    <a href="{{ route('activities.edit', $activity) }}">Edit</a>
    
    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
    </form>

    <br><br>
    <a href="{{ route('activities.index') }}">Kembali ke Daftar</a>
@endsection