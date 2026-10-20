<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Academic Transcript</title>
<style>
/* dompdf-safe stylesheet (CSS 2.1 subset). Based on exact RUSL_Transcript_Layout_Spec.xml */
@page { size: A4 portrait; margin: 0; }
html, body { margin: 0; padding: 0; }
body { font-family: calibri, sans-serif; font-size: 8pt; color: #000; }
.sym { font-family: "DejaVu Sans", sans-serif; }
img { border: 0; }

.page { position: relative; width: 210mm; height: 296mm; page-break-after: always; }
.page.last { page-break-after: avoid; }

/* Document ID header at top right (x=142.98mm, y=10.59mm) */
.docid { position: absolute; top: 10.5mm; left: 24.9mm; width: 167.9mm; text-align: right; font-family: Arial, sans-serif; font-size: 8pt; color: #000; line-height: 10px; }

/* Page number footer at bottom right (y=288mm) */
.pageno { position: absolute; top: 287.5mm; left: 24.9mm; width: 167.9mm; border-top: .5pt solid #d9d9d9;
          padding-top: 1.2mm; text-align: right; font-family: Arial, sans-serif; font-size: 8pt; color: #7f7f7f; line-height: 10px; }

/* Watermark */
.wm { position: absolute; left: 25mm; top: 75mm; width: 160mm; height: 160mm; opacity: 0.15; z-index: -1; }

.content { position: absolute; left: 24.9mm; top: 13.4mm; width: 167.9mm; }
.content.p2 { top: 15.0mm; }

/* Letterhead: crest (19.42x24.86mm), text block, QR (17.6x17.6mm) */
table.lh { width: 167.9mm; border-collapse: collapse; }
td.lh-crest { width: 19.42mm; vertical-align: top; padding: 0; }
td.lh-text  { vertical-align: top; padding-top: 1.8mm; padding-left: 2.2mm; }
td.lh-qr    { width: 17.6mm; vertical-align: top; padding-top: 3.5mm; text-align: center; }

.uni { font-family: calibri, sans-serif; font-size: 12pt; font-weight: bold; color: #4F6228; line-height: 14px; margin: 0 0 2.5mm 0; }
.fac { font-size: 9pt; color: #444444; line-height: 11px; margin: 0 0 2.8mm 0; white-space: nowrap; }
.fac b { font-size: 10pt; font-weight: bold; color: #444444; }
.lh-line { font-size: 7.5pt; color: #444444; line-height: 16px; }
.lh-line a { color: #0000FF; text-decoration: underline; }
.qrcap { font-size: 5.04pt; color: #444444; line-height: 6px; text-align: center; margin-top: 0.6mm; }
.lh-rule { width: 167.9mm; height: 2.83mm; display: block; margin-top: 1.5mm; margin-bottom: 0.5mm; }

.title { text-align: center; font-size: 12pt; font-weight: bold; line-height: 15px; margin-top: 0.3mm; margin-bottom: 2.2mm; }

/* Academic Transcript issued to */
table.issued { width: 167.9mm; border-collapse: collapse; font-size: 8.9pt; margin-bottom: 4.5mm; }
table.issued td { border: .5pt solid #000; height: 9.0mm; vertical-align: top; padding: 0.7mm 2mm; }
table.issued td.il { width: 50mm; font-weight: normal; }
table.issued td.iv { font-weight: bold; }

/* Green section header bars: fill #14331F, height ~4.9mm, text 10pt bold white */
table.bar { width: 167.9mm; border-collapse: collapse; margin-top: 1.6mm; margin-bottom: 0.8mm; background-color: #14331F; }
table.bar td { height: 4.4mm; vertical-align: middle; padding: 0 0 0 2mm; color: #FFFFFF; font-size: 8.2pt; font-weight: bold; }
table.bar2 { margin-top: 3.8mm; }
table.bar3 { margin-top: 2.0mm; }

/* Student info table: left col fill #EAF2F8, width 46mm, 10pt bold */
table.info { width: 167.9mm; border-collapse: collapse; font-size: 8.2pt; margin-bottom: 1.2mm; }
table.info th, table.info td { border: .5pt solid #000; height: 3.5mm; padding: 0.45mm 2mm 0.15mm 2mm; text-align: left; vertical-align: middle; line-height: 9.5px; }
table.info th { width: 46mm; font-weight: bold; background-color: #EAF2F8; color: #000000; }
table.info td { font-weight: normal; color: #000000; }

/* Course records 2-column layout (5mm gap between columns) */
table.pair { width: 167.9mm; border-collapse: collapse; margin-bottom: 2.6mm; table-layout: fixed; }
table.pair.gap { margin-bottom: 5.5mm; }
td.pl { width: 48.5%; vertical-align: top; padding: 0; }
td.pg { width: 3.0%; padding: 0; }
td.pr { width: 48.5%; vertical-align: top; padding: 0; }

.ytitle { font-size: 8.3pt; font-weight: bold; line-height: 10px; margin-bottom: 0.9mm; color: #000000; }

/* Course table: header fill #D9EAD3, 8pt bold. table-layout:fixed prevents overflow; width% on th sets proportions */
table.ct { width: 100%; border-collapse: collapse; table-layout: fixed; font-size: 6.9pt; }

table.ct th, table.ct td { border: .5pt solid #000000; padding: 0.55mm 0.6mm 0.55mm 1.2mm; line-height: 10.0px; vertical-align: middle; text-align: left; }
table.ct th { background-color: #D9EAD3; font-weight: bold; font-size: 7.1pt; color: #000000; }
table.ct .c-code { white-space: nowrap; font-size: 6.7pt; text-align: center; padding-left: 0.5mm; padding-right: 0.5mm; }
table.ct .c-title { text-align: left; word-wrap: break-word; overflow-wrap: break-word; white-space: normal; }
table.ct .c-cr { text-align: center; padding-left: 0.5mm; padding-right: 0.5mm; }
table.ct .c-gr { text-align: center; padding-left: 0.5mm; padding-right: 0.5mm; }
table.ct th.c-title, table.ct th.c-cr, table.ct th.c-gr, table.ct th.c-code { text-align: center; }
table.ct td.rt { height: 9mm; vertical-align: top; white-space: normal; }
img.dg { vertical-align: baseline; margin-left: 1px; }

.semsum { font-size: 6.9pt; font-weight: bold; margin-top: 1.2mm; line-height: 9px; white-space: nowrap; }
table.bar3 { margin-top: 5.5mm; margin-bottom: 1.2mm; }

/* Page 2 info blocks */
.ib { padding: 1.8mm 1mm; font-size: 7.2pt; line-height: 12.5px; text-align: justify; }
.ib p { margin: 0 0 2.0mm 0; }
table.gt { width: 167.9mm; border-collapse: collapse; font-size: 7.2pt; margin-top: 1.0mm; margin-bottom: 2.0mm; }
table.gt th, table.gt td { border: .5pt solid #000000; text-align: center; padding: 0.7mm 1mm; line-height: 9px; }
table.gt th { background-color: #D9EAD3; font-weight: bold; text-align: center; }
table.gt td.gl { text-align: left; font-weight: bold; width: 20mm; background-color: #ffffff; }
table.formula { margin-top: 1.5mm; margin-bottom: 1.5mm; border-collapse: collapse; font-size: 7.2pt; }
table.formula td { vertical-align: middle; }
td.f2 { padding: 0 1.5mm; }
table.frac td { text-align: center; line-height: 8px; padding: 0 1mm; }
table.frac td.fn { border-bottom: .5pt solid #000; }
table.sigs { width: 167.9mm; margin-top: 6.0mm; border-collapse: collapse; font-size: 7.3pt; }
table.sigs td { width: 33.33%; border: .5pt solid #000000; height: 13mm; vertical-align: top; padding: 1.6mm 2.2mm 0 2.2mm; }
.sig-title { font-weight: bold; }
.sig-details { margin-top: 5mm; line-height: 13.5px; }
</style>
</head>
<body>

@php
    $nonGpaCodes = ['ES 1102', 'AS 1101', 'EG 1101', 'IT 1101', 'EG 1201', 'IT 1201', 'ES 3103', 'AF 3102', 'PS 3224', 'CC 3201'];
    $daggerImg = file_exists(public_path('images/dagger.png'))
        ? '<img src="'.public_path('images/dagger.png').'" style="width:5px;height:8px;" class="dg" alt="†">'
        : '†';
@endphp

@foreach($data as $student)

@php
    $qrPath = public_path('images/qr-code.png');
@endphp

<!-- ===================== PAGE 1 ===================== -->
<div class="page">
  <div class="docid">Document ID: {{ $student['document_id'] }}</div>

  @if(file_exists(public_path('images/draft-watermark.png')))
    <img src="{{ public_path('images/draft-watermark.png') }}" class="wm">
  @endif

  <div class="content">
    <table class="lh" cellspacing="0" cellpadding="0"><tr>
      <td class="lh-crest">
        @if(file_exists(public_path('images/rusl-crest.png')))
          <img src="{{ public_path('images/rusl-crest.png') }}" style="width:19.42mm;height:24.86mm;">
        @elseif(file_exists(public_path('images/logo.png')))
          <img src="{{ public_path('images/logo.png') }}" style="width:18.5mm;height:25mm;">
        @endif
      </td>
      <td class="lh-text">
        <div class="uni">RAJARATA UNIVERSITY OF SRI LANKA</div>
        <div class="fac"><b>Faculty of Agriculture</b> &middot; Puliyankulama, Anuradhapura, Sri Lanka, 50000</div>
        <div class="lh-line">General: +94 25 2235103 &nbsp;<a href="http://www.agri.rjt.ac.lk/">www.agri.rjt.ac.lk</a></div>
        <div class="lh-line">Dean: +94 25 222 1610 &nbsp;<a href="mailto:dean@agri.rjt.ac.lk">dean@agri.rjt.ac.lk</a></div>
        <div class="lh-line">Senior Assistant Registrar: +94 25 222 1613 &nbsp;<a href="mailto:sar@agri.rjt.ac.lk">sar@agri.rjt.ac.lk</a></div>
      </td>
    </tr></table>

    @if(file_exists(public_path('images/rusl-divider.png')))
      <img src="{{ public_path('images/rusl-divider.png') }}" class="lh-rule">
    @else
      <div class="lh-rule" style="border-top: 2pt solid #4F81BD;"></div>
    @endif

    <div class="title">ACADEMIC TRANSCRIPT</div>
    <table class="issued" cellspacing="0" cellpadding="0"><tr>
      <td class="il">Academic Transcript issued to:</td>
      <td class="iv">{{ $submitto ?? '' }}</td>
    </tr></table>

    <table class="bar" cellspacing="0" cellpadding="0"><tr><td>STUDENT AND QUALIFICATION INFORMATION</td></tr></table>
    <table class="info" cellspacing="0" cellpadding="0">
      <tr><th>Full Name of Student</th><td>{{ $student['full_name'] }}</td></tr>
      <tr><th>Registration Number</th><td>{{ $student['registration_no'] }}</td></tr>
      <tr><th>Index Number</th><td>{{ $student['index_no'] }}</td></tr>
      <tr><th>Degree Awarded</th><td>{{ $student['program'] }} {{ $student['program_short'] }}</td></tr>
      <tr><th>Area of Specialization</th><td>{{ $student['specialization'] ?: 'Crop Science' }}</td></tr>
      <tr><th>SLQF Level</th><td>Level 6</td></tr>
      <tr><th>Medium of Instruction</th><td>English</td></tr>
      <tr><th>Programme Duration</th><td>Four Academic Years</td></tr>
      <tr><th>Date of Admission</th><td>{{ $student['admission_date'] ?: '-' }}</td></tr>
      <tr><th>Effective Date of the Degree</th><td>{{ $student['effective_date'] ?: '-' }}</td></tr>
      <tr><th>Total Credits Earned</th><td>{{ $student['total_credits'] }}</td></tr>
      <tr><th>Final GPA (FGPA)</th><td>{{ $student['gpa'] > 0 ? number_format($student['gpa'], 2) : '-' }}</td></tr>
      <tr><th>Degree Classification</th><td>{{ $student['class'] ?: '-' }}</td></tr>
    </table>

    <table class="bar bar2" cellspacing="0" cellpadding="0"><tr><td>RECORD OF COURSES, CREDITS AND GRADES</td></tr></table>

    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 1 SEM 1 -->
      <td class="pl" width="48.5%">
        <div class="ytitle">YEAR I &mdash; SEMESTER I - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[1][1]))
              @foreach($subjects[1][1] as $sid => $sub)
                @php
                  $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                  $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                @endphp
                <tr>
                  <td class="c-code">{{ $sub['code'] }}</td>
                  <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                  <td class="c-cr">{{ $sub['credits'] }}</td>
                  <td class="c-gr">{{ $gradeVal }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][1][1]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][1][1]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

      <td class="pg" width="3.0%"></td>

      <!-- YEAR 1 SEM 2 -->
      <td class="pr" width="48.5%">
        <div class="ytitle">YEAR I &mdash; SEMESTER II - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[1][2]))
              @foreach($subjects[1][2] as $sid => $sub)
                @php
                  $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                  $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                @endphp
                <tr>
                  <td class="c-code">{{ $sub['code'] }}</td>
                  <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                  <td class="c-cr">{{ $sub['credits'] }}</td>
                  <td class="c-gr">{{ $gradeVal }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][1][2]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][1][2]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

    </tr></table>

    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 2 SEM 1 -->
      <td class="pl" width="48.5%">
        <div class="ytitle">YEAR II &mdash; SEMESTER I - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[2][3]))
              @foreach($subjects[2][3] as $sid => $sub)
                @php
                  $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                  $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                @endphp
                <tr>
                  <td class="c-code">{{ $sub['code'] }}</td>
                  <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                  <td class="c-cr">{{ $sub['credits'] }}</td>
                  <td class="c-gr">{{ $gradeVal }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][2][3]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][2][3]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">&nbsp;</div>
      </td>

      <td class="pg" width="3.0%"></td>

      <!-- YEAR 2 SEM 2 -->
      <td class="pr" width="48.5%">
        <div class="ytitle">YEAR II &mdash; SEMESTER II - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[2][4]))
              @foreach($subjects[2][4] as $sid => $sub)
                @php
                  $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                  $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                @endphp
                <tr>
                  <td class="c-code">{{ $sub['code'] }}</td>
                  <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                  <td class="c-cr">{{ $sub['credits'] }}</td>
                  <td class="c-gr">{{ $gradeVal }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][2][4]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][2][4]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">&nbsp;</div>
      </td>

    </tr></table>
  </div>
  <div class="pageno">1 | P a g e</div>
</div>

<!-- ===================== PAGE 2 ===================== -->
<div class="page @if($loop->last) last @endif">
  <div class="docid">Document ID: {{ $student['document_id'] }}</div>

  @if(file_exists(public_path('images/draft-watermark.png')))
    <img src="{{ public_path('images/draft-watermark.png') }}" class="wm">
  @endif

  <div class="content p2">
    <table class="pair gap" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 3 SEM 1 -->
      <td class="pl" width="48.5%">
        <div class="ytitle">YEAR III &mdash; SEMESTER I - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[3][5]))
              @foreach($subjects[3][5] as $sid => $sub)
                @php
                  $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                  $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                @endphp
                <tr>
                  <td class="c-code">{{ $sub['code'] }}</td>
                  <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                  <td class="c-cr">{{ $sub['credits'] }}</td>
                  <td class="c-gr">{{ $gradeVal }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][3][5]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][3][5]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

      <td class="pg" width="3.0%"></td>

      <!-- YEAR 3 SEM 2 -->
      <td class="pr" width="48.5%">
        <div class="ytitle">YEAR III &mdash; SEMESTER II &ndash; Specialization Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[3][6]))
              @foreach($subjects[3][6] as $sid => $sub)
                @if(isset($student['results'][$sid]))
                  @php
                    $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                    $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                  @endphp
                  <tr>
                    <td class="c-code">{{ $sub['code'] }}</td>
                    <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                    <td class="c-cr">{{ $sub['credits'] }}</td>
                    <td class="c-gr">{{ $gradeVal }}</td>
                  </tr>
                @endif
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][3][6]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][3][6]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

    </tr></table>

    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 4 SEM 1 -->
      <td class="pl" width="48.5%">
        <div class="ytitle">YEAR IV &mdash; SEMESTER I - Specialization Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[4][7]))
              @foreach($subjects[4][7] as $sid => $sub)
                @if(isset($student['results'][$sid]))
                  @php
                    $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                    $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                  @endphp
                  <tr>
                    <td class="c-code">{{ $sub['code'] }}</td>
                    <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                    <td class="c-cr">{{ $sub['credits'] }}</td>
                    <td class="c-gr">{{ $gradeVal }}</td>
                  </tr>
                @endif
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][4][7]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][4][7]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

      <td class="pg" width="3.0%"></td>

      <!-- YEAR 4 SEM 2 -->
      <td class="pr" width="48.5%">
        <div class="ytitle">YEAR IV &mdash; SEMESTER II - Specialization Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code" width="16%" style="width: 16%;">Code</th>
            <th class="c-title" width="58%" style="width: 58%;">Course Title</th>
            <th class="c-cr" width="13%" style="width: 13%;">Credit</th>
            <th class="c-gr" width="13%" style="width: 13%;">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[4][8]))
              @foreach($subjects[4][8] as $sid => $sub)
                @if(isset($student['results'][$sid]))
                  @php
                    $isNonGpa = ($sub['credits'] == 0 || in_array(trim($sub['code']), $nonGpaCodes));
                    $gradeVal = $student['results'][$sid]['grade'] ?? '-';
                  @endphp
                  <tr>
                    <td class="c-code">{{ $sub['code'] }}</td>
                    <td class="c-title">{{ $sub['name'] }}@if($isNonGpa) {!! $daggerImg !!}@endif</td>
                    <td class="c-cr">{{ $sub['credits'] }}</td>
                    <td class="c-gr">{{ $gradeVal }}</td>
                  </tr>
                  @if(stripos($sub['name'], 'Research Project') !== false)
                    <tr>
                      <td class="c-code" style="font-weight:bold;font-size:7pt;">Research Title</td>
                      <td class="c-title rt" colspan="3" style="font-style:italic;">[Title of Research Project]</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="semsum">Semester Credits Earned: [{{ $student['semester_stats'][4][8]['credits'] ?? 0 }}] &nbsp; Semester GPA: [{{ $student['semester_stats'][4][8]['gpa'] ?? '0.00' }}]</div>
        <div class="ngpa">&nbsp;</div>
      </td>

    </tr></table>

    <table class="bar bar3" cellspacing="0" cellpadding="0"><tr><td>COURSE CODE, GRADING, CREDIT AND GPA INFORMATION</td></tr></table>
    <div class="ib">
      <table class="gt" cellspacing="0" cellpadding="0">
        <tr><th>Grade</th><th>A+</th><th>A</th><th>A-</th><th>B+</th><th>B</th><th>B-</th><th>C+</th><th>C</th><th>C-</th><th>D</th><th>E</th></tr>
        <tr><td class="gl">Marks</td><td><span class="sym">&#8805;</span> 85</td><td>80&ndash;84</td><td>75&ndash;79</td><td>70&ndash;74</td><td>65&ndash;69</td><td>60&ndash;64</td><td>55&ndash;59</td><td>50&ndash;54</td><td>45&ndash;49</td><td>40&ndash;44</td><td>&lt;40</td></tr>
        <tr><td class="gl">Grade Point</td><td>4.0</td><td>4.0</td><td>3.7</td><td>3.3</td><td>3.0</td><td>2.7</td><td>2.3</td><td>2.0</td><td>1.7</td><td>1.3</td><td>0.0</td></tr>
      </table>
      <p>A+ and A are differentiated by marks, but both carry the Grade Point of 4.0.</p>
      <p><b>Course codes:</b> Course codes comprise letters identifying the offering department/unit, followed by digits indicating the year of study, semester, and course number, respectively. [ES &ndash; Agricultural Engineering and Soil Science | AS &ndash; Agricultural Systems | AF &ndash; Animal and Food Sciences | PS &ndash; Plant Sciences | EG &ndash; English Language Teaching Unit | IT &ndash; Computer Centre | CC &ndash; Common Courses]</p>
      <p><b>Credit Definition:</b> 1 credit = 50 notional learning hours for taught, laboratory, and field studies; minimum 100 notional learning hours for industrial training and research, inclusive of relevant assessment and literature-survey time.</p>
      <p><b>GPA:</b> Grade Point Average</p>
      <table class="formula" cellspacing="0" cellpadding="0"><tr>
        <td class="f1"><b>FGPA =</b></td>
        <td class="f2"><table class="frac" cellspacing="0" cellpadding="0">
          <tr><td class="fn"><span class="sym">&#8721;</span>(<i>C<sub>ij</sub></i>&#215;<i>G<sub>i</sub></i>)</td></tr>
          <tr><td class="fd"><span class="sym">&#8721;</span><i>C<sub>i</sub></i></td></tr>
        </table></td>
        <td class="f3">where: <i>C<sub>ij</sub></i>= Credit value of the i<sup>th</sup> course offered in the j<sup>th</sup> semester; <i>G<sub>i</sub></i>= Grade point obtained for the i<sup>th</sup> course</td>
      </tr></table>
    </div>

    <table class="bar bar3" cellspacing="0" cellpadding="0"><tr><td>DEGREE CLASSIFICATION</td></tr></table>
    <div class="ib"><b>First Class</b> <span class="sym">&#8805;</span> 3.70 | <b>Second Class (Upper Division)</b> 3.30&ndash;3.69 | <b>Second Class (Lower Division)</b> 3.00&ndash;3.29 | <b>Pass</b> 2.00&ndash;2.99</div>

    <table class="bar bar3" cellspacing="0" cellpadding="0"><tr><td>AUTHENTICATION</td></tr></table>
    <div class="ib">This certificate is issued from the records approved by the Senate of Rajarata University of Sri Lanka. Its authenticity may be verified using the QR code or the Document ID. The original printed certificate shall bear the faculty seal and the authorized signature(s). Any alteration renders this certificate invalid.</div>

    <table class="sigs" cellspacing="0" cellpadding="0"><tr>
      <td>
        <div class="sig-title">Prepared by</div>
        <div class="sig-details">[Name]<br>Management Assistant<br>Date:</div>
      </td>
      <td>
        <div class="sig-title">Checked by</div>
        <div class="sig-details">[Name]<br>Management Assistant<br>Date:</div>
      </td>
      <td>
        <div class="sig-title">Certified by</div>
        <div class="sig-details">Mr. M.M.S. Sanjeewa<br>Senior Assistant Registrar<br>Date:</div>
      </td>
    </tr></table>
  </div>
  <div class="pageno">2 | P a g e</div>
</div>

@endforeach

</body>
</html>
