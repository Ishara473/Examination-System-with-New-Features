<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if($isValid) ✅ Valid Transcript
        @elseif($transcript) ❌ Revoked Transcript
        @else ⚠️ Not Found
        @endif
        | Faculty of Agriculture, RUSL
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            padding: 2.5rem 1.5rem;
        }

        /* Main card */
        .card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            max-width: 560px;
            width: 100%;
            overflow: hidden;
            animation: fadeUp .45s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Header section inside card */
        .card-header {
            padding: 2rem 2.5rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid #f3f0eb;
        }

        .logo-wrap { margin-bottom: 1.2rem; }
        .logo-wrap img { height: 60px; object-fit: contain; }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .55rem 1.2rem;
            border-radius: 99px;
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .04em;
            margin-bottom: 1rem;
        }
        .status-badge.valid   { background: #d1fae5; color: #065f46; border: 1.5px solid #6ee7b7; }
        .status-badge.revoked { background: #fee2e2; color: #7f1d1d; border: 1.5px solid #fca5a5; }
        .status-badge.unknown { background: #fef3c7; color: #78350f; border: 1.5px solid #fde68a; }

        .card-header h1 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: .3rem;
        }
        .card-header p.sub {
            font-size: .87rem;
            color: #6b7280;
        }

        /* Card body */
        .card-body { padding: 1.8rem 2.5rem; }

        /* Section label */
        .section-lbl {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: .85rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .section-lbl::after {
            content: '';
            flex: 1;
            border-top: 1px solid #f0ebe4;
        }
        .section-lbl + .info-grid { margin-bottom: 1.4rem; }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .65rem;
        }
        .info-cell {
            background: #fdfaf7;
            border: 1px solid #f0ebe4;
            border-radius: 10px;
            padding: .8rem 1rem;
        }
        .info-cell.full { grid-column: 1 / -1; }
        .info-cell .lbl {
            font-size: .67rem;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: .2rem;
        }
        .info-cell .val {
            font-size: .95rem;
            font-weight: 600;
            color: #111827;
            line-height: 1.3;
        }
        .info-cell .val.mono {
            font-family: 'Courier New', monospace;
            font-size: .85rem;
            font-weight: 700;
            letter-spacing: .02em;
        }
        .info-cell .val.gpa {
            font-size: 1.25rem;
            font-weight: 800;
            color: #7b1113;
        }
        .info-cell .val.active-status {
            color: #059669;
            font-weight: 700;
        }

        /* Verified stamp */
        .stamp {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: .85rem;
            margin-top: 1.3rem;
        }
        .stamp-icon {
            width: 40px; height: 40px;
            background: #059669;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: .95rem;
            flex-shrink: 0;
        }
        .stamp-text { font-size: .8rem; color: #166534; line-height: 1.55; }
        .stamp-text strong { display: block; font-weight: 700; color: #14532d; margin-bottom: .1rem; }

        /* Warning / danger panels */
        .panel-danger {
            background: #fff5f5;
            border: 1.5px solid #fecaca;
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-top: .8rem;
        }
        .panel-danger .lbl { font-size: .68rem; font-weight: 700; letter-spacing: .09em; text-transform: uppercase; color: #ef4444; margin-bottom: .25rem; }
        .panel-danger .val { font-size: .9rem; color: #7f1d1d; font-weight: 500; }

        .panel-warn {
            background: #fffbeb;
            border: 1.5px solid #fde68a;
            border-radius: 10px;
            padding: 1.1rem 1.3rem;
            font-size: .87rem;
            color: #78350f;
            line-height: 1.7;
        }

        /* Card footer */
        .card-footer {
            padding: 1.1rem 2.5rem 1.5rem;
            border-top: 1px solid #f3f0eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .footer-uni {
            font-size: .75rem;
            color: #9ca3af;
            line-height: 1.5;
        }
        .footer-uni strong { display: block; font-weight: 600; color: #4b5563; font-size: .8rem; }

        .btn-verify-another {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .6rem 1.2rem;
            background: linear-gradient(135deg, #7b1113, #a31517);
            color: white;
            border-radius: 8px;
            font-size: .82rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 3px 10px rgba(123,17,19,.3);
            transition: opacity .2s, transform .15s;
        }
        .btn-verify-another:hover { opacity: .9; transform: translateY(-1px); }

        /* Page copyright below card */
        .page-footer {
            margin-top: 1.8rem;
            font-size: .75rem;
            color: rgba(255,255,255,.45);
            text-align: center;
            line-height: 1.7;
        }
        .page-footer a { color: rgba(255,255,255,.65); text-decoration: none; }
        .page-footer a:hover { text-decoration: underline; }

        @media (max-width: 480px) {
            .info-grid { grid-template-columns: 1fr; }
            .card-body, .card-header, .card-footer { padding-left: 1.4rem; padding-right: 1.4rem; }
        }
    </style>
</head>
<body>

<div class="card">

    {{-- Header --}}
    <div class="card-header">
        <div class="logo-wrap">
            <img src="{{ asset('img/logo.png') }}" alt="RUSL" onerror="this.style.display='none'">
        </div>

        @if($isValid)
            <div class="status-badge valid"><i class="fas fa-circle-check"></i> Transcript Verified & Valid</div>
            <h1>Authenticity Confirmed</h1>
            <p class="sub">This transcript is authentic and currently active.</p>
        @elseif($transcript)
            <div class="status-badge revoked"><i class="fas fa-ban"></i> Transcript {{ ucfirst($transcript->status) }}</div>
            <h1>Transcript No Longer Valid</h1>
            <p class="sub">This document exists in our records but its status has been changed.</p>
        @else
            <div class="status-badge unknown"><i class="fas fa-triangle-exclamation"></i> Record Not Found</div>
            <h1>No Matching Transcript</h1>
            <p class="sub">The details you provided do not match any record in our system.</p>
        @endif
    </div>

    {{-- Body --}}
    <div class="card-body">

        @if($isValid)
            <p class="section-lbl"><i class="fas fa-user"></i> Student Information</p>
            <div class="info-grid">
                <div class="info-cell">
                    <div class="lbl">Full Name</div>
                    <div class="val">{{ $transcript->student->full_name ?? '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Index Number</div>
                    <div class="val">{{ $transcript->student->index_no ?? '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Registration No</div>
                    <div class="val">{{ $transcript->student->registration_no ?? '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Document ID</div>
                    <div class="val mono">{{ $transcript->document_id }}</div>
                </div>
            </div>

            <p class="section-lbl"><i class="fas fa-graduation-cap"></i> Academic Details</p>
            <div class="info-grid">
                <div class="info-cell full">
                    <div class="lbl">Degree Awarded</div>
                    <div class="val">{{ $transcript->degree_name ?? '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Class</div>
                    <div class="val">{{ $transcript->class_name ?? '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Final GPA</div>
                    <div class="val gpa">{{ $transcript->fgpa ?? '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Issued At</div>
                    <div class="val">{{ $transcript->issued_at ? $transcript->issued_at->format('d M Y') : '—' }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Status</div>
                    <div class="val active-status"><i class="fas fa-circle-check"></i> Active</div>
                </div>
            </div>

            <div class="stamp">
                <div class="stamp-icon"><i class="fas fa-lock"></i></div>
                <div class="stamp-text">
                    <strong>Officially Verified</strong>
                    Faculty of Agriculture, Rajarata University of Sri Lanka &mdash; verified {{ now()->format('d M Y \a\t H:i') }} (IST)
                </div>
            </div>

        @elseif($transcript)
            <div class="info-grid">
                <div class="info-cell">
                    <div class="lbl">Document ID</div>
                    <div class="val mono">{{ $transcript->document_id }}</div>
                </div>
                <div class="info-cell">
                    <div class="lbl">Status</div>
                    <div class="val" style="color:#dc2626;font-weight:700;"><i class="fas fa-ban"></i> {{ ucfirst($transcript->status) }}</div>
                </div>
            </div>
            @if($transcript->status_reason)
            <div class="panel-danger">
                <div class="lbl">Reason</div>
                <div class="val">{{ $transcript->status_reason }}</div>
            </div>
            @endif

        @else
            <div class="panel-warn">
                <i class="fas fa-magnifying-glass" style="margin-right:.4rem;"></i>
                No transcript record matches Document ID <strong>{{ $documentId }}</strong> with the Index Number you provided.
                Please double-check both values as printed on the transcript and try again.
                <br><br>
                If the issue persists, contact the Faculty of Agriculture Examination Division.
            </div>
        @endif

    </div>

    {{-- Footer --}}
    <div class="card-footer">
        <div class="footer-uni">
            <strong>Faculty of Agriculture</strong>
            Rajarata University of Sri Lanka
        </div>
        <a href="{{ url('/verify') }}" class="btn-verify-another">
            <i class="fas fa-arrow-left"></i> Verify Another
        </a>
    </div>

</div>

<p class="page-footer">
    &copy; {{ date('Y') }} Faculty of Agriculture, Rajarata University of Sri Lanka.<br>
    Having trouble? <a href="#">Contact the Examination Division</a>
</p>

</body>
</html>
