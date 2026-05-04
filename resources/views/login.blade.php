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
			   font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			   min-height: 100vh;
			   background: linear-gradient(120deg, rgba(34,193,195,0.7) 0%, rgba(253,187,45,0.5) 100%), url('https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
			   background-size: cover;
			   color: #22223b;
			   display: flex;
			   align-items: center;
			   justify-content: center;
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
			   max-width: 400px;
			   background: rgba(255, 255, 255, 0.22);
			   border-radius: 22px;
			   padding: 44px 36px 36px 36px;
			   box-shadow: 0 8px 40px 0 rgba(34, 49, 63, 0.18);
			   backdrop-filter: blur(22px) saturate(180%);
			   -webkit-backdrop-filter: blur(22px) saturate(180%);
			   border: 1.5px solid rgba(255, 255, 255, 0.28);
			   transition: box-shadow 0.3s;
			   position: relative;
		   }
		   .auth-card:hover {
			   box-shadow: 0 16px 60px 0 rgba(34, 49, 63, 0.28);
		   }
		   .auth-logo {
			   width: 56px;
			   height: 56px;
			   border-radius: 50%;
			   background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
			   display: flex;
			   align-items: center;
			   justify-content: center;
			   margin: 0 auto 18px auto;
			   box-shadow: 0 2px 12px 0 rgba(67, 233, 123, 0.18);
			   font-size: 2rem;
			   color: #fff;
		   }
		   .auth-title {
			   margin: 0;
			   font-size: 2rem;
			   font-weight: 700;
			   letter-spacing: 0.5px;
			   text-align: center;
		   }
		   .auth-subtitle {
			   margin: 8px 0 0;
			   font-size: 1rem;
			   color: #4b5563;
			   text-align: center;
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
			   border-radius: 12px;
			   padding: 13px 14px;
			   background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
			   color: #22223b;
			   font-size: 1.08rem;
			   font-weight: 700;
			   cursor: pointer;
			   box-shadow: 0 4px 18px 0 rgba(67, 233, 123, 0.13);
			   letter-spacing: 0.5px;
			   transition: background 0.2s, transform 0.2s;
		   }
		   .btn:hover {
			   background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
			   transform: translateY(-2px) scale(1.04);
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
			   <div class="auth-logo">
				   <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="12" fill="url(#paint0_linear_1_2)"/><path d="M7.5 12.5L11 16L17 10" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><defs><linearGradient id="paint0_linear_1_2" x1="0" y1="0" x2="24" y2="24" gradientUnits="userSpaceOnUse"><stop stop-color="#43e97b"/><stop offset="1" stop-color="#38f9d7"/></linearGradient></defs></svg>
			   </div>
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
