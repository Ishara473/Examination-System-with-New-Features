<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 18mm 21mm 16mm; }
        * { box-sizing: border-box; }
        body { font-family: calibri, DejaVu Sans, sans-serif; color: #000; font-size: 9pt; }
        .header { border-bottom: 2pt solid #4F81BD; padding-bottom: 3mm; }
        .header img { display: block; width: 100%; height: auto; }
        .document-id { margin-top: 2mm; text-align: right; color: #444; font-family: Arial, sans-serif; font-size: 8pt; }
        .title { text-align: center; padding: 4mm 0 3mm; border-bottom: .5pt solid #d9d9d9; }
        .title h2 { margin: 0; color: #14331F; font-size: 13pt; }
        .title p { margin: 1.5mm 0 0; color: #444; font-size: 8.5pt; }
        .section { padding: 3.5mm 0 2.5mm; border-bottom: .5pt solid #d9d9d9; }
        .section h3 { margin: 0 0 2.5mm; padding: 1.5mm 2mm; background: #14331F; color: white; font-size: 8.5pt; font-weight: bold; }
        .section h3.green { background: #14331F; }
        .section h3.gold { background: #4F81BD; }
        .note { margin-bottom: 2mm; color: #444; font-size: 8pt; }
        .grid { width: 100%; border-collapse: collapse; margin: 0; table-layout: fixed; }
        .grid td { width: 50%; vertical-align: top; }
        .grid td { padding: 1mm 1.5mm 1mm 0; }
        .grid td + td { padding-left: 1.5mm; padding-right: 0; }
        .label { display: block; margin-bottom: 1mm; color: #444; font-size: 7.5pt; font-weight: bold; }
        .value { min-height: 7mm; padding: 1.4mm 2mm; border: .5pt solid #000; background: #EAF2F8; font-weight: bold; }
        .line { height: 9mm; border-bottom: .5pt solid #000; }
        .payment { padding: 3mm 3.5mm; border: .5pt solid #000; background: #EAF2F8; color: #000; line-height: 1.5; }
        .payment strong { color: #14331F; }
        .payment table { width: 100%; margin-top: 1.5mm; border-collapse: collapse; }
        .payment td { padding: .8mm 0; }
        .payment td:first-child { width: 30mm; color: #14331F; font-weight: bold; text-transform: uppercase; font-size: 7.5pt; }
        .footer { margin-top: 3mm; padding: 2.5mm; border-top: .5pt solid #d9d9d9; color: #444; text-align: center; font-size: 7.5pt; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('images/pdf_header.png')))
        <img src="{{ public_path('images/pdf_header.png') }}" alt="Rajarata University of Sri Lanka">
        @else
        <div style="font-size: 14pt; font-weight: bold; color: #4F6228;">RAJARATA UNIVERSITY OF SRI LANKA</div>
        <div style="font-size: 9pt; color: #444;">Faculty of Agriculture · Puliyankulama, Anuradhapura, Sri Lanka</div>
        @endif
    </div>

    <div class="document-id">Document ID: {{ $transcript->document_id }}</div>

    <div class="title">
        <h2>FORMAL TRANSCRIPT VERIFICATION REQUEST</h2>
        <p>For official use by employers, licensing boards, embassies, and academic institutions</p>
    </div>

    <div class="section">
        <h3 class="green">SECTION A - STUDENT DETAILS (PRE-FILLED BY SYSTEM)</h3>
        <div class="note">These details were populated from the verified university database. Do not alter.</div>
        <table class="grid">
            <tr><td colspan="2"><span class="label">Full Name</span><div class="value">{{ $student->full_name ?? '—' }}</div></td></tr>
            <tr>
                <td><span class="label">Registration Number</span><div class="value">{{ $student->registration_no ?? '—' }}</div></td>
                <td><span class="label">Index Number</span><div class="value">{{ $student->index_no ?? '—' }}</div></td>
            </tr>
            <tr>
                <td><span class="label">Document ID</span><div class="value">{{ $transcript->document_id }}</div></td>
                <td><span class="label">Degree</span><div class="value">{{ $transcript->degree_name ?? '—' }}</div></td>
            </tr>
            <tr>
                <td><span class="label">Final GPA</span><div class="value">{{ $transcript->fgpa ?? '—' }}</div></td>
                <td><span class="label">Classification</span><div class="value">{{ $transcript->class_name ?? '—' }}</div></td>
            </tr>
            <tr><td colspan="2"><span class="label">Effective Date of Degree</span><div class="value">{{ $transcript->effective_date ? $transcript->effective_date->format('d F Y') : '—' }}</div></td></tr>
        </table>
    </div>

    <div class="section">
        <h3>SECTION B - REQUESTER DETAILS (TO BE FILLED BY APPLICANT)</h3>
        <table class="grid">
            <tr><td colspan="2"><span class="label">Full Name of Requester</span><div class="line"></div></td></tr>
            <tr><td colspan="2"><span class="label">Organization / Institution</span><div class="line"></div></td></tr>
            <tr><td colspan="2"><span class="label">Purpose of Verification</span><div class="line"></div></td></tr>
            <tr><td><span class="label">Contact Number</span><div class="line"></div></td><td><span class="label">Email Address</span><div class="line"></div></td></tr>
            <tr><td><span class="label">Signature</span><div class="line" style="height:34px"></div></td><td><span class="label">Date</span><div class="line"></div></td></tr>
        </table>
    </div>

    <div class="section">
        <h3 class="gold">SECTION C - PAYMENT &amp; SUBMISSION INSTRUCTIONS</h3>
        <div class="payment">
            <strong>Service Fee:</strong> LKR XXXX (per transcript verification letter)<br>
            <strong>Payment Method - Bank Deposit:</strong>
            <table>
                <tr><td>Bank</td><td>Bank of Ceylon</td></tr>
                <tr><td>Branch</td><td>Anuradhapura</td></tr>
                <tr><td>Account Name</td><td>Rajarata University of Sri Lanka</td></tr>
                <tr><td>Account No.</td><td>XXXX XXXX XXXX</td></tr>
            </table>
            <br><strong>Please attach the bank deposit slip</strong> when submitting this form.<br><br>
            <strong>Submit to:</strong> Senior Assistant Registrar (Examinations), Faculty of Agriculture, Rajarata University of Sri Lanka<br>
            Email: sar@agri.rjt.ac.lk &nbsp;|&nbsp; Monday-Friday, 8:30 AM-4:30 PM
        </div>
    </div>

    <div class="footer">
        Generated on {{ now()->format('d F Y') }} via the RUSL Online Transcript Verification System.<br>
        Document ID: {{ $transcript->document_id }} &nbsp;|&nbsp; For office use only: Reference No. __________________
    </div>
</body>
</html>