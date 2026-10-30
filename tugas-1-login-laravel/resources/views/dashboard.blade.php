<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed black; padding-bottom: 10px;">
        <h2>Dashboard</h2>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <p>Selamat datang, {{ Auth::user()->nama_lengkap }}!</p>
    <p>Ini adalah halaman dashboard yang hanya dapat diakses oleh pengguna yang telah login.</p>
    <p>Username Anda: {{ Auth::user()->username }}</p>
    @if ($errors->any())
    <div style="color: red; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/cart/add" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit">Test Tambah Cart</button>
    </form>
</body>
</html>