<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <p>Silakan login dengan username dan password Anda.</p>
    @error('login_failed')
        <div style="color: red; margin-bottom: 10px;">
            [{{ $message }}]
        </div>
    @enderror

    <form action="/login" method="POST">
        @csrf
        <div>
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>
        <br>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>