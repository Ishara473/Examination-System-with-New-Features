<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript Verification | Faculty of Agriculture, RUSL</title>
    <meta name="description" content="Verify the authenticity of transcripts issued by the Faculty of Agriculture, Rajarata University of Sri Lanka.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #7b1113 0%, #4a0a0b 50%, #1a0304 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            max-width: 520px;
            width: 100%;
            padding: 2.5rem 3rem;
            text-align: center;
        }

        .logo-wrap {
            margin-bottom: 1.5rem;
        }
        .logo-wrap img {
            height: 80px;
            object-fit: contain;
        }

        .badge {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .35rem .9rem;
            border-radius: 99px;
            border: 1px solid #fde68a;
            margin-bottom: 1.2rem;
        }

        h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: .5rem;
        }

        p.subtitle {
            font-size: .93rem;
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        form { text-align: left; }

        label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .4rem;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .input-wrap {
            position: relative;
            margin-bottom: .4rem;
        }

        .input-wrap i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: .95rem;
        }

        input[type="text"] {
            width: 100%;
            padding: .85rem 1rem .85rem 2.8rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: .95rem;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #7b1113;
            box-shadow: 0 0 0 3px rgba(123,17,19,.12);
        }

        input[type="text"]::placeholder { color: #d1d5db; }

        .hint {
            font-size: .78rem;
            color: #9ca3af;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        .separator {
            display: flex;
            align-items: center;
            gap: .7rem;
            margin: 1rem 0;
            color: #9ca3af;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .separator::before, .separator::after {
            content: '';
            flex: 1;
            border-top: 1px dashed #e5e7eb;
        }

        button[type="submit"] {
            width: 100%;
            padding: .9rem;
            background: linear-gradient(135deg, #7b1113, #a31517);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            margin-top: 1.5rem;
            box-shadow: 0 4px 14px rgba(123,17,19,.35);
        }

        button[type="submit"]:hover { opacity: .9; transform: translateY(-1px); }
        button[type="submit"]:active { transform: translateY(0); }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: .9rem 1rem;
            margin-bottom: 1.2rem;
            color: #b91c1c;
            font-size: .88rem;
            text-align: left;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .security-note {
            margin-top: 1.5rem;
            padding: .85rem 1rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            display: flex;
            gap: .6rem;
            align-items: flex-start;
            text-align: left;
        }
        .security-note i { color: #16a34a; font-size: .85rem; flex-shrink: 0; margin-top: .1rem; }
        .security-note p { font-size: .78rem; color: #166534; line-height: 1.5; }

        .footer-note {
            margin-top: 2rem;
            font-size: .78rem;
            color: rgba(255,255,255,.5);
            text-align: center;
        }
        .footer-note a { color: rgba(255,255,255,.75); text-decoration: none; }
        .footer-note a:hover { text-decoration: underline; }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(20px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .card { animation: fadeUp .5s ease; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-wrap">
            <img src="{{ asset('img/logo.png') }}" alt="RUSL Logo" onerror="this.style.display='none'">
        </div>

        <div class="badge"><i class="fas fa-shield-alt"></i> &nbsp; Official Verification Portal</div>

        <h1>Transcript Verification</h1>
        <p class="subtitle">
            Enter the details printed on your official transcript to verify its authenticity with the Faculty of Agriculture, Rajarata University of Sri Lanka.
        </p>

        @if($errors->any())
        <div class="alert-error">
            <i class="fas fa-circle-exclamation"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ url('/verify') }}" method="POST" autocomplete="off">
            @csrf

            <label for="document_id">Document ID</label>
            <div class="input-wrap">
                <i class="fas fa-file-contract"></i>
                <input
                    type="text"
                    id="document_id"
                    name="document_id"
                    placeholder="e.g. RUSL/FOA/2026/TR/138"
                    value="{{ old('document_id') }}"
                    autofocus
                    required
                >
            </div>
            <p class="hint"><i class="fas fa-info-circle"></i> Printed at the top of the transcript</p>

            <div class="separator">and</div>

            <label for="index_no">Index Number</label>
            <div class="input-wrap">
                <i class="fas fa-user-graduate"></i>
                <input
                    type="text"
                    id="index_no"
                    name="index_no"
                    placeholder="e.g. AC/2019/011"
                    value="{{ old('index_no') }}"
                    required
                >
            </div>
            <p class="hint"><i class="fas fa-info-circle"></i> Printed next to the student name on the transcript</p>

            <button type="submit">
                <i class="fas fa-magnifying-glass-check"></i> Verify Transcript
            </button>
        </form>

        <div class="security-note">
            <i class="fas fa-lock"></i>
            <p>Both fields must match the same transcript record. Your verification attempt is logged for security purposes.</p>
        </div>
    </div>

    <p class="footer-note">
        &copy; {{ date('Y') }} Faculty of Agriculture, Rajarata University of Sri Lanka.<br>
        Having trouble? <a href="#">Contact the Examination Division</a>
    </p>
</body>
</html>
