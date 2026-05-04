<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | {{ config('app.name', 'Laravel') }}</title>
	<style>
		* { box-sizing: border-box; }
		body {
			margin: 0;
			font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(180deg, #f4f6fb 0%, #edf1f8 100%);
			color: #1f2937;
		}
		.auth-wrap {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 24px;
		}
		.auth-card {
			width: 100%;
			max-width: 420px;
			background: #ffffff;
			border-radius: 14px;
			padding: 28px;
			box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
		}
		.auth-title {
			margin: 0;
			font-size: 28px;
			font-weight: 700;
		}
		.auth-subtitle {
			margin: 8px 0 0;
			font-size: 14px;
			color: #64748b;
		}
		.error-box {
			margin-top: 16px;
			padding: 12px 14px;
			border-radius: 10px;
			border: 1px solid #fecaca;
			background: #fef2f2;
			color: #b91c1c;
			font-size: 14px;
		}
		.form {
			margin-top: 20px;
		}
		.field {
			margin-bottom: 14px;
		}
		label {
			display: block;
			margin-bottom: 6px;
			font-size: 14px;
			font-weight: 600;
		}
		input[type="email"],
		input[type="password"],
		input[type="text"] {
			width: 100%;
			padding: 10px 12px;
			border: 1px solid #cbd5e1;
			border-radius: 10px;
			font-size: 14px;
		}
		input:focus {
			outline: none;
			border-color: #64748b;
			box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.15);
		}
		.remember {
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 14px;
			color: #475569;
			margin-bottom: 14px;
		}
		.btn {
			width: 100%;
			border: 0;
			border-radius: 10px;
			padding: 11px 14px;
			background: #0f172a;
			color: #fff;
			font-size: 15px;
			font-weight: 600;
			cursor: pointer;
		}
		.btn:hover {
			background: #1e293b;
		}
		.auth-footer {
			margin-top: 18px;
			font-size: 14px;
			color: #475569;
		}
		.auth-footer a {
			color: #0f172a;
			font-weight: 600;
		}
	</style>
</head>
<body>
	<div class="auth-wrap">
		<div class="auth-card">
			<h1 class="auth-title">Welcome Back</h1>
			<p class="auth-subtitle">Login to continue.</p>

		@if ($errors->any())
			<div class="error-box">
				<ul class="list-disc pl-5">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if (session('status'))
			<div class="error-box" style="border-color:#bbf7d0; background:#f0fdf4; color:#15803d;">
				{{ session('status') }}
			</div>
		@endif

		<form method="POST" action="{{ route('login.attempt') }}" class="form">
			@csrf
			<div class="field">
				<label for="email">Email</label>
				<input
					id="email"
					name="email"
					type="email"
					value="{{ old('email') }}"
					required
					autofocus
				>
			</div>

			<div class="field">
				<label for="password">Password</label>
				<input
					id="password"
					name="password"
					type="password"
					required
				>
			</div>

			<label class="remember">
				<input type="checkbox" name="remember">
				Remember me
			</label>

			<button
				type="submit"
				class="btn"
			>
				Login
			</button>
		</form>

		<p class="auth-footer">
			No account yet?
			<a href="{{ route('register') }}">Create one</a>
		</p>
		</div>
	</div>
</body>
</html>
