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
            color: #1e293b;
        }
        main { width: 100%; max-width: 760px; margin: 36px auto 60px; padding: 0 20px; }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            overflow: hidden;
        }

        .card-header { padding: 28px 32px 22px; border-bottom: 1px solid #cbd5e1; }
        .card-header h1 { font-family: Georgia, serif; font-size: 22px; color: #1a3a6b; margin-bottom: 0; }
        .card-header p { color: #64748b; font-size: 14px; margin-top: 6px; line-height: 1.5; }
        .card-body { padding: 28px 32px; }

        .logo-wrap {
            margin-bottom: 1.5rem;
        }
        .logo-wrap img {
            height: 80px;
            object-fit: contain;
        }

        .badge {
            display: inline-block;
            background: #e8f0fb;
            color: #1a3a6b;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .35rem .9rem;
            border-radius: 99px;
            border: 1px solid #cbd5e1;
            margin-bottom: 1rem;
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
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: .9rem;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #1a3a6b;
            box-shadow: 0 0 0 3px rgba(26,58,107,.12);
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
            border-top: 1px solid #cbd5e1;
        }

        button[type="submit"] {
            width: 100%;
            padding: .9rem;
            background: #1a3a6b;
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
            box-shadow: 0 4px 14px rgba(26,58,107,.25);
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

        .scan-box, .service-box { margin-top: 20px; padding: 14px 16px; border-radius: 8px; font-size: 13px; line-height: 1.6; text-align: left; }
        .scan-box { background: #e8f0fb; border-left: 4px solid #1a3a6b; color: #1a3a6b; }
        .service-box { background: #f8fafc; color: #64748b; }
        .service-box strong, .scan-box strong { color: #1e293b; }
        .scan-box i { margin-right: 5px; }

        .card-footer { padding: 14px 32px; border-top: 1px solid #cbd5e1; color: #64748b; font-size: 12px; line-height: 1.5; }

        .footer-note {
            margin-top: 1.8rem;
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

        @media (max-width: 600px) {
            main { margin: 20px auto 40px; padding: 0 12px; }
            .card-header, .card-body, .card-footer { padding-left: 16px; padding-right: 16px; }
        }
    </style>
</head>
<body>
    <main>
      <div class="card">
        <div class="card-header">
            <div class="badge"><i class="fas fa-shield-alt"></i> &nbsp; Official Verification Portal</div>
            <h1>Transcript Verification</h1>
            <p>Verify the authenticity of an academic transcript issued by the Faculty of Agriculture, RUSL.</p>
        </div>

        <div class="card-body">

        @if($errors->any())
        <div class="alert-error">
            <i class="fas fa-circle-exclamation"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ url('/verify') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="verification_method" value="{{ request()->filled('doc') ? 'qr_code' : 'manual' }}">

            <label for="document_id">Document ID</label>
            <div class="input-wrap">
                <i class="fas fa-file-contract"></i>
                <input
                    type="text"
                    id="document_id"
                    name="document_id"
                    placeholder="e.g. RUSL/FOA/2026/TR/042"
                    value="{{ old('document_id', request('doc')) }}"
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
                    placeholder="e.g. AG/19017"
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

        <div class="scan-box">
            <i class="fas fa-mobile-screen-button"></i><strong>Scan via QR Code</strong> &mdash; Point your phone camera at the QR code printed on the physical transcript. It will open the verification result page automatically &mdash; no typing needed.
        </div>

        <div class="service-box">
            <strong>What this service provides:</strong><br>
            This online verification confirms the <strong>authenticity and final award status</strong> of official transcripts only. Individual course-by-course grades are <strong>not displayed online</strong>. For certified detailed reports, please contact the Examinations Division.
        </div>
        </div>
        <div class="card-footer">Use the Document ID and Index Number printed on the same transcript.</div>
      </div>
    </main>

    <p class="footer-note">
        &copy; {{ date('Y') }} Faculty of Agriculture, Rajarata University of Sri Lanka.<br>
        Having trouble? <a href="#">Contact the Examination Division</a>
    </p>
</body>
</html>
