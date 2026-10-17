<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Academic Transcript</title>
<style>
/* dompdf-safe stylesheet (CSS 2.1 subset). No variables, flexbox, grid, transforms, calc(). */
@page { size: A4 portrait; margin: 0; }
html, body { margin: 0; padding: 0; }
body { font-family: Carlito, Calibri, "DejaVu Sans", sans-serif; font-size: 10pt; color: #000; }
img { border: 0; }

.page { position: relative; width: 210mm; height: 296mm; page-break-after: always; overflow: hidden; }
.page.last { page-break-after: avoid; height: 296mm; }
.content { position: absolute; left: 24.6mm; top: 13.2mm; width: 169mm; }
.content.p2 { top: 22mm; }

.docid { position: absolute; top: 9mm; left: 24.6mm; width: 169mm; text-align: right; font-size: 8.5pt; line-height: 10px; }
.pageno { position: absolute; top: 287.5mm; left: 24.6mm; width: 169mm; border-top: .5pt solid #d9d9d9;
          padding-top: 1.2mm; text-align: right; font-size: 8pt; color: #7f7f7f; line-height: 10px; }
.wm { position: absolute; }

/* letterhead */
table.lh { width: 169mm; height: 29.7mm; border-collapse: collapse; }
td.lh-crest { width: 24.5mm; vertical-align: top; }
td.lh-text  { vertical-align: top; padding-top: 1.6mm; }
td.lh-qr    { width: 17.6mm; vertical-align: top; padding-top: 5.1mm; text-align: center; }
.uni { font-size: 13pt; font-weight: bold; color: #3b6e22; line-height: 17px; }
.fac { font-size: 10pt; color: #595959; line-height: 14px; margin-top: 1.4mm; }
.fac b { color: #404040; }
.lh-line { font-size: 8pt; color: #595959; line-height: 12.9px; }
.lh-line a { color: #0563c1; text-decoration: underline; }
.qrcap { font-size: 4.5pt; color: #595959; line-height: 6px; }
.lh-rule { height: 0; border-top: 1.3pt solid #4a7ebb; }

.title { margin-top: 1.4mm; height: 5mm; text-align: center; font-size: 11.5pt; font-weight: bold; line-height: 5mm; }
table.issued { width: 169mm; border-collapse: collapse; margin-top: 1.7mm; font-size: 10pt; }
table.issued td { border: .75pt solid #000; height: 11.2mm; vertical-align: top; padding: 0.9mm 2mm 0 2mm; }
table.issued td.il { width: 53.7mm; padding-left: 2.6mm; }

/* green bars */
table.bar { width: 169mm; border-collapse: collapse; margin-top: 3.2mm; background-color: #153f27; }
table.bar td { height: 5.5mm; vertical-align: middle; padding: 0 0 0 2.3mm; color: #fff; font-size: 9.5pt; font-weight: bold; white-space: nowrap; }
table.bar2 { margin-top: 4.1mm; }
table.bar3 { margin-top: 2.2mm; }

/* student info */
table.info { width: 169mm; border-collapse: collapse; margin-top: 1.7mm; font-size: 9.5pt; }
table.info th, table.info td { border: .75pt solid #000; height: 4.27mm; padding: 0 0 0 1.8mm; text-align: left; vertical-align: middle; line-height: 11px; }
table.info th { width: 47.3mm; font-weight: bold; padding-left: 2.6mm; }

/* course records */
table.pair { margin-left: 2.7mm; border-collapse: collapse; margin-bottom: 1.0mm; }
td.pl, td.pr { width: 79.9mm; vertical-align: top; padding: 0; }
td.pg { width: 3.9mm; padding: 0; }
.ytitle { font-size: 8pt; font-weight: bold; line-height: 9.5px; margin-top: 1.3mm; margin-bottom: .6mm; }
.y1b { color: #2e6b34; }
table.ct { width: 79.9mm; border-collapse: collapse; table-layout: fixed; font-size: 8pt; }
table.ct th, table.ct td { border: .5pt solid #3a3a3a; padding: .8pt 3pt .8pt 3pt; line-height: 9.1px; vertical-align: middle; text-align: left; }
table.ct th { background-color: #d9ead3; font-weight: bold; }
table.ct .c-code { width: 17%; white-space: nowrap; }
table.ct .c-cr { width: 14.5%; text-align: center; }
table.ct .c-gr { width: 14.5%; text-align: center; }
table.ct th.c-title, table.ct th.c-cr, table.ct th.c-gr { text-align: center; }
table.ct td.rt { height: 15mm; vertical-align: top; white-space: normal; }
img.dg { vertical-align: baseline; }
.semsum { font-size: 7.5pt; font-weight: bold; margin-top: 0.7mm; line-height: 9px; white-space: nowrap; }
.ngpa { font-size: 7.5pt; margin-top: 1.0mm; line-height: 9px; }

/* page 2 info blocks */
.ib { padding: 1.2mm 2.3mm 0 2.3mm; font-size: 7.5pt; line-height: 8.6px; text-align: justify; }
.ib p { margin: 0 0 1.1mm 0; }
table.gt { width: 164mm; border-collapse: collapse; font-size: 7.5pt; margin-bottom: 1mm; }
table.gt th, table.gt td { border: .5pt solid #3a3a3a; text-align: center; padding: .7pt 2pt; line-height: 9px; }
table.gt th { text-align: left; font-weight: bold; width: 17%; background-color: #d9ead3; }
table.formula { margin-top: 1mm; border-collapse: collapse; font-size: 7.5pt; }
table.formula td { vertical-align: middle; }
td.f2 { padding: 0 1.5mm; }
table.frac td { text-align: center; line-height: 9px; padding: 0 1mm; }
table.frac td.fn { border-bottom: .5pt solid #000; }
table.sigs { width: 164mm; margin: 7mm 0 0 2.3mm; border-collapse: collapse; font-size: 8pt; line-height: 10px; }
table.sigs td { width: 33%; vertical-align: top; }
</style>
</head>
<body>

@php
    $nonGpaCodes = ['ES 1102', 'AS 1101', 'EG 1101', 'IT 1101', 'EG 1201', 'IT 1201', 'ES 3103', 'AF 3102', 'PS 3224', 'CC 3201'];
    $daggerImg = '<img src="'.public_path('images/dagger.png').'" style="width:6px;height:9px;" class="dg" alt="+">';
@endphp

@foreach($data as $student)

@php
    $qrDataUri = "https://chart.googleapis.com/chart?chs=70x70&cht=qr&chld=L|0&chl=" . urlencode($student['verify_url']);
@endphp

<!-- ===================== PAGE 1 ===================== -->
<div class="page">
  <div class="docid">Document ID: {{ $student['document_id'] }}</div>

  <div class="content">
    <table class="lh" cellspacing="0" cellpadding="0"><tr>
      <td class="lh-crest">
        @if(file_exists(public_path('images/logo.png')))
          <img src="{{ public_path('images/logo.png') }}" style="width:18.5mm;height:25mm;">
        @endif
      </td>
      <td class="lh-text">
        <div class="uni">RAJARATA UNIVERSITY OF SRI LANKA</div>
        <div class="fac"><b>Faculty of Agriculture</b> &middot; Puliyankulama, Anuradhapura, Sri Lanka, 50000</div>
        <div class="lh-line">General:&nbsp; +94 25 2235103 &nbsp;<a href="http://www.agri.rjt.ac.lk">www.agri.rjt.ac.lk</a></div>
        <div class="lh-line">Dean: +94 25 222 1610 &nbsp;<a href="mailto:dean@agri.rjt.ac.lk">dean@agri.rjt.ac.lk</a></div>
        <div class="lh-line">Senior Assistant Registrar: +94 25 222 1613 &nbsp;<a href="mailto:sar@agri.rjt.ac.lk">sar@agri.rjt.ac.lk</a></div>
      </td>
      <td class="lh-qr">
        <img src="{{ $qrDataUri }}" style="width:17.6mm;height:17.6mm;">
        <div class="qrcap">Scan to verify</div>
      </td>
    </tr></table>
    <div class="lh-rule"></div>

    <div class="title">ACADEMIC TRANSCRIPT</div>
    <table class="issued" cellspacing="0" cellpadding="0"><tr>
      <td class="il">Academic Transcript issued to:</td>
      <td class="iv"><b>{{ $submitto ?? 'Whom It May Concern' }}</b></td>
    </tr></table>

    <table class="bar" cellspacing="0" cellpadding="0"><tr><td>STUDENT AND QUALIFICATION INFORMATION</td></tr></table>
    <table class="info" cellspacing="0" cellpadding="0">
      <tr><th>Full Name of Student</th><td><b>{{ $student['full_name'] }}</b></td></tr>
      <tr><th>Registration Number</th><td><b>{{ $student['registration_no'] }}</b></td></tr>
      <tr><th>Index Number</th><td><b>{{ $student['index_no'] }}</b></td></tr>
      <tr><th>Degree Awarded</th><td>{{ $student['program'] }} {{ $student['program_short'] }}</td></tr>
      <tr><th>Area of Specialization</th><td>{{ $student['specialization'] ?: 'Core Programme' }}</td></tr>
      <tr><th>SLQF Level</th><td>{{ $student['slqf_level'] }}</td></tr>
      <tr><th>Medium of Instruction</th><td>English</td></tr>
      <tr><th>Programme Duration</th><td>{{ $student['duration'] }}</td></tr>
      <tr><th>Date of Admission</th><td>{{ $student['admission_date'] ?: '-' }}</td></tr>
      <tr><th>Effective Date of the Degree</th><td>{{ $student['effective_date'] ?: '-' }}</td></tr>
      <tr><th>Total Credits Earned</th><td><b>{{ $student['total_credits'] }}</b></td></tr>
      <tr><th>Final GPA (FGPA)</th><td><b>{{ $student['gpa'] > 0 ? number_format($student['gpa'], 2) : '-' }}</b></td></tr>
      <tr><th>Degree Classification</th><td><b>{{ $student['class'] ?: '-' }}</b></td></tr>
    </table>

    <table class="bar bar2" cellspacing="0" cellpadding="0"><tr><td>RECORD OF COURSES, CREDITS AND GRADES</td></tr></table>

    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 1 SEM 1 -->
      <td class="pl">
        <div class="ytitle">YEAR I &mdash; SEMESTER I - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][1][1]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][1][1]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

      <td class="pg"></td>

      <!-- YEAR 1 SEM 2 -->
      <td class="pr">
        <div class="ytitle y1b">YEAR I &mdash; SEMESTER II - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][1][2]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][1][2]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">&nbsp;</div>
      </td>

    </tr></table>

    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 2 SEM 1 -->
      <td class="pl">
        <div class="ytitle">YEAR II &mdash; SEMESTER I - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][2][3]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][2][3]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">&nbsp;</div>
      </td>

      <td class="pg"></td>

      <!-- YEAR 2 SEM 2 -->
      <td class="pr">
        <div class="ytitle">YEAR II &mdash; SEMESTER II - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][2][4]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][2][4]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">&nbsp;</div>
      </td>

    </tr></table>
  </div>
  <div class="pageno">1 | P a g e</div>
</div>

<!-- ===================== PAGE 2 ===================== -->
<div class="page last">
  <div class="docid">Document ID: {{ $student['document_id'] }}</div>

  <div class="content p2">
    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 3 SEM 1 -->
      <td class="pl">
        <div class="ytitle">YEAR III &mdash; SEMESTER I - Core Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][3][5]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][3][5]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">{!! $daggerImg !!} Non-GPA contributing courses</div>
      </td>

      <td class="pg"></td>

      <!-- YEAR 3 SEM 2 -->
      <td class="pr">
        <div class="ytitle">YEAR III &mdash; SEMESTER II &ndash; Specialization Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
          </tr></thead>
          <tbody>
            @if(isset($subjects[3][6]))
              @foreach($subjects[3][6] as $sid => $sub)
                @if(isset($student['results'][$sid]) || (int)6 < (int)$optSubSemStart)
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][3][6]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][3][6]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">&nbsp;</div>
      </td>

    </tr></table>

    <table class="pair" cellspacing="0" cellpadding="0"><tr>

      <!-- YEAR 4 SEM 1 -->
      <td class="pl">
        <div class="ytitle">YEAR IV &mdash; SEMESTER I - Specialization Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][4][7]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][4][7]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">&nbsp;</div>
      </td>

      <td class="pg"></td>

      <!-- YEAR 4 SEM 2 -->
      <td class="pr">
        <div class="ytitle">YEAR IV &mdash; SEMESTER II - Specialization Programme</div>
        <table class="ct" cellspacing="0" cellpadding="0">
          <thead><tr>
            <th class="c-code">Code</th>
            <th class="c-title">Course Title</th>
            <th class="c-cr">Credit</th>
            <th class="c-gr">Grade</th>
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
        <div class="semsum">Sem. Credits: {{ $student['semester_stats'][4][8]['credits'] ?? 0 }} &nbsp;&nbsp; Sem. GPA: {{ $student['semester_stats'][4][8]['gpa'] ?? '0.00' }}</div>
        <div class="ngpa">&nbsp;</div>
      </td>

    </tr></table>

    <table class="bar bar3" cellspacing="0" cellpadding="0"><tr><td>COURSE CODE, GRADING, CREDIT AND GPA INFORMATION</td></tr></table>
    <div class="ib">
      <table class="gt" cellspacing="0" cellpadding="0">
        <tr><th>Grade</th><td>A+</td><td>A</td><td>A-</td><td>B+</td><td>B</td><td>B-</td><td>C+</td><td>C</td><td>C-</td><td>D</td><td>E</td></tr>
        <tr><th>Marks</th><td>&#8805; 85</td><td>80&ndash;84</td><td>75&ndash;79</td><td>70&ndash;74</td><td>65&ndash;69</td><td>60&ndash;64</td><td>55&ndash;59</td><td>50&ndash;54</td><td>45&ndash;49</td><td>40&ndash;44</td><td>&lt;40</td></tr>
        <tr><th>Grade Point</th><td>4.0</td><td>4.0</td><td>3.7</td><td>3.3</td><td>3.0</td><td>2.7</td><td>2.3</td><td>2.0</td><td>1.7</td><td>1.3</td><td>0.0</td></tr>
      </table>
      <p><b>A+ and A are differentiated by marks, but both carry the Grade Point of 4.0.</b></p>
      <p><b>Course codes:</b> Course codes comprise letters identifying the offering department/unit, followed by digits indicating the year of study, semester, and course number, respectively. [ES &ndash; Agricultural Engineering and Soil Science | AS &ndash; Agricultural Systems | AF &ndash; Animal and Food Sciences | PS &ndash; Plant Sciences | EG &ndash; English Language Teaching Unit | IT &ndash; Computer Centre | CC &ndash; Common Courses]</p>
      <p><b>Credit Definition:</b> 1 credit = 50 notional learning hours for taught, laboratory, and field studies; minimum 100 notional learning hours for industrial training and research, inclusive of relevant assessment and literature-survey time.</p>
      <p><b>GPA:</b> Grade Point Average</p>
      <table class="formula" cellspacing="0" cellpadding="0"><tr>
        <td class="f1"><b>FGPA =</b></td>
        <td class="f2"><table class="frac" cellspacing="0" cellpadding="0">
          <tr><td class="fn">&#8721;(<i>C<sub>ij</sub></i>&#215;<i>G<sub>i</sub></i>)</td></tr>
          <tr><td class="fd">&#8721;<i>C<sub>i</sub></i></td></tr>
        </table></td>
        <td class="f3">where: <i>C<sub>ij</sub></i>= Credit value of the i<sup>th</sup> course offered in the j<sup>th</sup> semester; <i>G<sub>i</sub></i>= Grade point obtained for the i<sup>th</sup> course</td>
      </tr></table>
    </div>

    <table class="bar bar3" cellspacing="0" cellpadding="0"><tr><td>DEGREE CLASSIFICATION</td></tr></table>
    <div class="ib"><b>First Class</b> &#8805; 3.70 | <b>Second Class (Upper Division)</b> 3.30&ndash;3.69 | <b>Second Class (Lower Division)</b> 3.00&ndash;3.29 | <b>Pass</b> 2.00&ndash;2.99</div>

    <table class="bar bar3" cellspacing="0" cellpadding="0"><tr><td>AUTHENTICATION</td></tr></table>
    <div class="ib">This certificate is issued from the records approved by the Senate of Rajarata University of Sri Lanka. Its authenticity may be verified using the QR code or the Document ID. The original printed certificate shall bear the faculty seal and the authorized signature(s). Any alteration renders this certificate invalid.</div>

    <table class="sigs" cellspacing="0" cellpadding="0"><tr>
      <td><b>Prepared by</b><br>&nbsp;<br>Management Assistant<br>Date: {{ date('d/m/Y') }}</td>
      <td><b>Checked by</b><br>&nbsp;<br>Management Assistant<br>Date: {{ date('d/m/Y') }}</td>
      <td><b>Certified by</b><br>Mr. M.M.S. Sanjeewa<br>Senior Assistant Registrar<br>Date: {{ date('d/m/Y') }}</td>
    </tr></table>
  </div>
  <div class="pageno">2 | P a g e</div>
</div>

@endforeach

</body>
</html>
