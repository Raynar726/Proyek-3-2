@extends('layouts.app')

@section('content')
    <h1>Tempat Sampah (Trash)</h1>
    
    <a href="{{ route('activities.index') }}">Kembali ke Daftar Utama</a>
    <hr>

    @forelse ($activities as $activity)
        <article class="card" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
            <h3>{{ $activity->title }}</h3>
            <p>Dihapus pada: {{ $activity->deleted_at }}</p>
            
            <form action="{{ route('activities.restore', $activity->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" onclick="return confirm('Yakin ingin memulihkan data ini?')">Restore Data</button>
            </form>
        </article>
    @empty
        <p>Tempat sampah kosong.</p>
    @endforelse
@endsection