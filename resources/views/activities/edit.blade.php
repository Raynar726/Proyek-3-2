@extends('layouts.app')

@section('content')
    <h1>Ubah Kegiatan</h1>
    
    <form action="{{ route('activities.update', $activity) }}" method="POST">
        @csrf
        @method('PUT')
        
        @include('activities._form')
        
        <button type="submit">Simpan Perubahan</button>
    </form>
    
    <a href="{{ route('activities.show', $activity) }}">Batal</a>
@endsection