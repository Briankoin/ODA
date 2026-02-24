<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
        }

        .card {
            text-align: center;
            padding: 3rem 2.5rem;
            max-width: 480px;
            width: 90%;
        }

        .icon { font-size: 4rem; margin-bottom: 1.5rem; }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #f8fafc;
        }

        p {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #94a3b8;
            margin-bottom: 0.75rem;
        }

        .badge {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.4rem 1rem;
            background: #1e40af;
            border-radius: 999px;
            font-size: 0.85rem;
            color: #bfdbfe;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🔧</div>
        <h1>Under Maintenance</h1>
        <p>We're making some improvements to bring you a better experience.</p>
        <p>We'll be back shortly — thank you for your patience!</p>
        <span class="badge">Back soon</span>
    </div>
</body>
</html>