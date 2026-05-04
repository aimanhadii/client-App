<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Client App') }}</title>
    <style>
        :root {
            --bg: #f4f6fb;
            --card: #ffffff;
            --text: #10223b;
            --muted: #5f7086;
            --line: #d9e1ec;
            --primary: #0f4c81;
            --primary-2: #1769aa;
            --accent: #f28f3b;
            --accent-2: #ffd166;
            --success: #1f9d6b;
            --shadow: 0 22px 45px rgba(16, 34, 59, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 10% 12%, rgba(242, 143, 59, 0.20), transparent 22%),
                radial-gradient(circle at 86% 78%, rgba(23, 105, 170, 0.18), transparent 25%),
                linear-gradient(160deg, #f7f9fd 0%, #edf2f8 55%, #e9eff7 100%);
        }

        .frame {
            width: min(1100px, 92%);
            margin: 28px auto;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .brand-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #e76f51);
            box-shadow: 0 0 0 6px rgba(242, 143, 59, 0.16);
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            border: 1px solid var(--line);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.75);
            color: var(--text);
            text-decoration: none;
            padding: 9px 14px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-1px);
            border-color: #b7c4d5;
            background: #fff;
        }

        .btn-primary {
            border-color: var(--primary);
            background: linear-gradient(145deg, var(--primary-2), var(--primary));
            color: #fff;
        }

        .btn-primary:hover {
            filter: brightness(1.03);
            border-color: var(--primary-2);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 22px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero-left {
            padding: 52px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            border: 1px solid #d7e5f5;
            background: #f3f8ff;
            color: #295a87;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            padding: 6px 11px;
            margin-bottom: 18px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(30px, 5vw, 48px);
            line-height: 1.08;
            letter-spacing: -0.8px;
        }

        .lead {
            margin: 14px 0 0;
            max-width: 54ch;
            font-size: 16px;
            line-height: 1.7;
            color: var(--muted);
        }

        .action-row {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 28px;
        }

        .stat {
            border: 1px solid #e3ebf5;
            border-radius: 12px;
            padding: 12px;
            background: #fbfdff;
        }

        .stat strong {
            display: block;
            font-size: 18px;
            margin-bottom: 4px;
        }

        .stat span {
            font-size: 12px;
            color: var(--muted);
        }

        .hero-right {
            position: relative;
            padding: 24px;
            background:
                radial-gradient(circle at 26% 24%, rgba(242, 143, 59, 0.26), transparent 36%),
                radial-gradient(circle at 80% 88%, rgba(15, 76, 129, 0.24), transparent 40%),
                linear-gradient(145deg, #0f4c81 0%, #143e66 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .panel {
            width: min(360px, 100%);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.55);
            padding: 18px;
            backdrop-filter: blur(5px);
        }

        .panel h3 {
            margin: 0;
            font-size: 18px;
            color: #173e66;
        }

        .panel ul {
            list-style: none;
            margin: 14px 0 0;
            padding: 0;
            display: grid;
            gap: 10px;
        }

        .panel li {
            border-radius: 10px;
            border: 1px solid #d7e5f5;
            background: #f8fbff;
            padding: 10px 12px;
            font-size: 13px;
            color: #31577c;
        }

        .footer-note {
            margin-top: 14px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.86);
            text-align: center;
            letter-spacing: 0.2px;
        }

        .logout-form {
            margin: 0;
        }

        @media (max-width: 980px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .hero-left {
                padding: 34px 26px;
            }

            .hero-right {
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .nav {
                align-items: flex-start;
                gap: 12px;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="frame">
        <nav class="nav">
            <a class="brand" href="{{ url('/') }}" aria-label="Home">
                <span class="brand-dot" aria-hidden="true"></span>
                <span style="font-size:20px;letter-spacing:0.5px;font-weight:800;">Client Portal</span>
            </a>

            <div class="nav-actions">
                @if (session()->has('api_token'))
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endif
            </div>
        </nav>

        <section class="hero">
            <div class="hero-left">
                <span class="chip" style="background:#eaf6ff;color:#0f4c81;border:1.5px solid #b3d8f6;">API-Connected UI</span>
                <h1 style="font-weight:900;">Smarter product management.<br>API-first, seamless, secure.</h1>
                <p class="lead">
                    Welcome to your modern client portal. Sign in to manage products, powered by secure API token authentication and a responsive, distraction-free interface.
                </p>

                <div class="action-row">
                    @if (session()->has('api_token'))
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Open Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Start with Login</a>
                        <a href="{{ route('register') }}" class="btn">Create Account</a>
                    @endif
                </div>

                <div class="stats">
                    <div class="stat">
                        <strong>🔑 API Token</strong>
                        <span>Secure, session-based authentication.</span>
                    </div>
                    <div class="stat">
                        <strong>📦 Product CRUD</strong>
                        <span>Full-featured product management.</span>
                    </div>
                    <div class="stat">
                        <strong>📱 Responsive</strong>
                        <span>Optimized for all devices.</span>
                    </div>
                </div>
            </div>

            <aside class="hero-right">
                <div>
                    <div class="panel" style="box-shadow:0 4px 24px rgba(15,76,129,0.10);">
                        <h3 style="font-weight:800;letter-spacing:0.2px;">Quick Start</h3>
                        <ul>
                            <li>1. Register or log in with your API account.</li>
                            <li>2. Check your token is active (backend DB).</li>
                            <li>3. Start managing your products.</li>
                        </ul>
                    </div>
                    <div class="footer-note" style="color:#eaf6ff;opacity:0.92;">API-connected UI &copy; {{ date('Y') }}</div>
                </div>
            </aside>
        </section>
    </div>
</body>
</html>