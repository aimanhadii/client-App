<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register | {{ config('app.name', 'Laravel') }}</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');

		* { box-sizing: border-box; margin: 0; padding: 0; }

		body {
			font-family: 'Nunito', sans-serif;
			min-height: 100vh;
			background: linear-gradient(135deg, #f97316 0%, #ec4899 35%, #8b5cf6 70%, #3b82f6 100%);
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 24px;
			position: relative;
			overflow: hidden;
		}

		/* floating blobs */
		body::before, body::after {
			content: '';
			position: fixed;
			border-radius: 50%;
			opacity: 0.25;
			animation: float 8s ease-in-out infinite;
			pointer-events: none;
		}
		body::before {
			width: 420px; height: 420px;
			background: #fbbf24;
			top: -120px; left: -100px;
		}
		body::after {
			width: 350px; height: 350px;
			background: #34d399;
			bottom: -100px; right: -80px;
			animation-delay: 3s;
		}
		@keyframes float {
			0%, 100% { transform: translateY(0) scale(1); }
			50%       { transform: translateY(30px) scale(1.05); }
		}

		.auth-card {
			width: 100%;
			max-width: 440px;
			background: rgba(255, 255, 255, 0.92);
			backdrop-filter: blur(16px);
			border-radius: 24px;
			padding: 36px 32px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
			position: relative;
			z-index: 1;
			border: 1.5px solid rgba(255,255,255,0.6);
		}

		.emoji-top {
			font-size: 48px;
			text-align: center;
			display: block;
			margin-bottom: 10px;
			animation: bounce 2s ease infinite;
		}
		@keyframes bounce {
			0%, 100% { transform: translateY(0); }
			50%       { transform: translateY(-8px); }
		}

		.auth-title {
			text-align: center;
			font-size: 28px;
			font-weight: 800;
			background: linear-gradient(90deg, #f97316, #ec4899, #8b5cf6);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.auth-subtitle {
			text-align: center;
			margin-top: 6px;
			font-size: 14px;
			color: #6b7280;
			font-weight: 600;
		}

		.error-box {
			margin-top: 16px;
			padding: 12px 16px;
			border-radius: 12px;
			background: #fff1f2;
			border: 1.5px solid #fda4af;
			color: #be123c;
			font-size: 13px;
			font-weight: 600;
		}
		.error-box ul { padding-left: 18px; }

		.form { margin-top: 22px; }

		.field { margin-bottom: 16px; }

		label {
			display: block;
			margin-bottom: 6px;
			font-size: 13px;
			font-weight: 700;
			color: #4b5563;
			letter-spacing: 0.3px;
		}

		.input-wrap {
			position: relative;
		}
		.input-icon {
			position: absolute;
			left: 12px;
			top: 50%;
			transform: translateY(-50%);
			font-size: 16px;
			pointer-events: none;
		}

		input[type="email"],
		input[type="password"],
		input[type="text"] {
			width: 100%;
			padding: 11px 14px 11px 38px;
			border: 2px solid #e5e7eb;
			border-radius: 12px;
			font-size: 14px;
			font-family: inherit;
			color: #111827;
			background: #fafafa;
			transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
		}
		input:focus {
			outline: none;
			border-color: #ec4899;
			background: #fff;
			box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.15);
		}

		.btn {
			width: 100%;
			border: 0;
			border-radius: 14px;
			padding: 13px;
			background: linear-gradient(135deg, #f97316, #ec4899);
			color: #fff;
			font-size: 16px;
			font-weight: 800;
			font-family: inherit;
			cursor: pointer;
			letter-spacing: 0.5px;
			transition: transform 0.15s, box-shadow 0.15s;
			box-shadow: 0 6px 20px rgba(236, 72, 153, 0.4);
			margin-top: 4px;
		}
		.btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 28px rgba(236, 72, 153, 0.5);
		}
		.btn:active {
			transform: translateY(0);
		}

		.divider {
			display: flex;
			align-items: center;
			gap: 10px;
			margin: 18px 0;
			color: #9ca3af;
			font-size: 12px;
			font-weight: 600;
		}
		.divider::before, .divider::after {
			content: '';
			flex: 1;
			height: 1px;
			background: #e5e7eb;
		}

		.auth-footer {
			text-align: center;
			font-size: 14px;
			color: #6b7280;
			font-weight: 600;
		}
		.auth-footer a {
			font-weight: 800;
			background: linear-gradient(90deg, #8b5cf6, #3b82f6);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			text-decoration: none;
		}
		.auth-footer a:hover {
			text-decoration: underline;
		}

		.confetti {
			position: fixed;
			top: 0; left: 0;
			width: 100%; height: 100%;
			pointer-events: none;
			z-index: 0;
			overflow: hidden;
		}
		.dot {
			position: absolute;
			width: 10px; height: 10px;
			border-radius: 50%;
			animation: fall linear infinite;
			opacity: 0.7;
		}
		@keyframes fall {
			0%   { transform: translateY(-20px) rotate(0deg); opacity: 0.8; }
			100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
		}
	</style>
</head>
<body>

	<!-- confetti dots -->
	<div class="confetti" aria-hidden="true">
		<div class="dot" style="left:5%;  background:#f97316; width:8px;  height:8px;  animation-duration:6s;  animation-delay:0s;"></div>
		<div class="dot" style="left:15%; background:#ec4899; width:12px; height:12px; animation-duration:8s;  animation-delay:1s;"></div>
		<div class="dot" style="left:25%; background:#fbbf24; width:7px;  height:7px;  animation-duration:7s;  animation-delay:2s;"></div>
		<div class="dot" style="left:38%; background:#34d399; width:10px; height:10px; animation-duration:9s;  animation-delay:0.5s;"></div>
		<div class="dot" style="left:52%; background:#8b5cf6; width:9px;  height:9px;  animation-duration:6.5s;animation-delay:3s;"></div>
		<div class="dot" style="left:65%; background:#3b82f6; width:11px; height:11px; animation-duration:8.5s;animation-delay:1.5s;"></div>
		<div class="dot" style="left:78%; background:#f43f5e; width:8px;  height:8px;  animation-duration:7.5s;animation-delay:0.8s;"></div>
		<div class="dot" style="left:90%; background:#fbbf24; width:10px; height:10px; animation-duration:6s;  animation-delay:4s;"></div>
	</div>

	<div class="auth-card">
		<span class="emoji-top">🎉</span>
		<h1 class="auth-title">Join the Party!</h1>
		<p class="auth-subtitle">Create your free account in seconds ✨</p>

		@if ($errors->any())
			<div class="error-box">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" action="{{ route('register.store') }}" class="form">
			@csrf

			<div class="field">
				<label for="name">Your Name</label>
				<div class="input-wrap">
					<span class="input-icon">😊</span>
					<input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus placeholder="What do we call you?">
				</div>
			</div>

			<div class="field">
				<label for="email">Email Address</label>
				<div class="input-wrap">
					<span class="input-icon">📧</span>
					<input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="you@example.com">
				</div>
			</div>

			<div class="field">
				<label for="password">Password</label>
				<div class="input-wrap">
					<span class="input-icon">🔒</span>
					<input id="password" name="password" type="password" required placeholder="Make it strong!">
				</div>
			</div>

			<div class="field">
				<label for="password_confirmation">Confirm Password</label>
				<div class="input-wrap">
					<span class="input-icon">✅</span>
					<input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Same as above">
				</div>
			</div>

			<button type="submit" class="btn">
				🚀 Create My Account
			</button>
		</form>

		<div class="divider">already one of us?</div>

		<p class="auth-footer">
			<a href="{{ route('login') }}">Sign in to your account →</a>
		</p>
	</div>

</body>
</html>
