<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(52, 49, 49, 0.9);
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
            display: flex;
            max-width: 800px;
            width: 100%;
            overflow: hidden;
        }

        .left {
            flex: 1;
            background: url('{{ asset('images/logindanregis.jpg') }}') no-repeat center center;
            background-size: cover;
        }

        .right {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #451a03;
        }

        .register-form {
            width: 100%;
        }

        .register-form h2 {
            margin-bottom: 20px;
            color: rgb(248, 245, 245);
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: rgb(248, 245, 245);
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid rgb(248, 245, 245);
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            background-color: #451a03;
            color: #ecf0f1;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: rgb(248, 245, 245);
            border: none;
            border-radius: 5px;
            color: rgb(52, 49, 49);
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: rgb(133, 126, 126);
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            color: rgb(248, 245, 245);
        }

        .login-link a {
            color: rgb(238, 223, 122);
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: rgb(102, 67, 24);
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left"></div>
    <div class="right">
        <div class="register-form">
            <h2>Register</h2>

            @if($errors->any())
                <div class="error-message">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="input-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required minlength="3" placeholder="Masukkan nama lengkap">
                </div>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required minlength="3" placeholder="Masukkan username">
                </div>
                <div class="input-group">
                    <label for="phone">No Telepon</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required pattern="[0-9]{10,14}" title="Masukkan angka 10-14 digit" placeholder="Contoh: 081234567890">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter">
                </div>
                <div class="input-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6" placeholder="Masukkan ulang password">
                </div>
                <button type="submit">Register</button>
            </form>
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            alert("Password dan Konfirmasi Password harus sama!");
            return false;
        }

        return true;
    }

    @if(session('success'))
    alert('{{ session('success') }}');
    window.location.href = '{{ route('login') }}';
    @endif
</script>
</body>
</html>
