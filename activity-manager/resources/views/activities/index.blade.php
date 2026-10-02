@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('activities.create') }}">Tambah Kegiatan</a>
    <hr>
    <form action="{{ route('activities.index') }}" method="GET" style="margin-bottom: 20px;">
    <!-- Cari Kode/Judul -->
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul/kode..." style="margin-right: 10px;">

    <!-- Filter Kategori -->
    <select name="category_id" style="margin-right: 10px;">
        <option value="">-- Semua Kategori --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <!-- Filter Status -->
    <select name="status" style="margin-right: 10px;">
        <option value="">-- Semua Status --</option>
        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <!-- Urutkan Tanggal -->
    <select name="sort" style="margin-right: 10px;">
        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
    </select>

    <button type="submit">Cari / Filter</button>
    <a href="{{ route('activities.index') }}" style="margin-left: 10px;">Reset</a>
</form>

    @forelse ($activities as $activity)
        <article class="card">
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse

    <div style="margin-top: 20px;">
        {{ $activities->links() }}
    </div>
@endsection