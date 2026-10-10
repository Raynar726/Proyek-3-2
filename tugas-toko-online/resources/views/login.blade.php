<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Online</title>
</head>
<body>
    <h2>Login Toko Online</h2>

    <!-- Pesan Error -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Masuk</button>
    </form>

    <br>
    <a href="/">[ Kembali ke Daftar Barang ]</a>
</body>
</html>