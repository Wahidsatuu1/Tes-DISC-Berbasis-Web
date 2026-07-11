<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.personality_style_analysis') }} - {{ $biodata->nama_lengkap }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 0; padding: 0; }
        .header-table { width: 100%; border: 2px solid #000; padding: 5px; margin-bottom: 10px; }
        .header-table td { padding: 3px; }
        .title-box { font-size: 36px; font-weight: bold; letter-spacing: 2px; }
        .subtitle { font-size: 14px; }
        .score-box { width: 100%; border-collapse: collapse; margin-bottom: 15px; border: 2px solid #000; }
        .score-box th, .score-box td { border: 1px solid #000; padding: 5px; text-align: center; }
        .score-header th { font-size: 18px; font-weight: bold; }
        
        .graphs-container { width: 100%; }
        .graph-wrapper { width: 230px; float: left; margin-right: 15px; border: 1px solid #000; height: 460px; position: relative;}
        .graph-wrapper:last-child { margin-right: 0; }
        .graph-title { text-align: center; font-weight: bold; margin-bottom: 5px; border-bottom: 1px solid #000; padding: 5px 0;}
        .graph-y-axis { position: absolute; left: 5px; top: 25px; bottom: 20px; display: flex; flex-direction: column; justify-content: space-between; font-size: 9px; }
        .graph-area { position: absolute; left: 25px; width: 190px; top: 45px; height: 380px; }
        
        /* Mensimulasikan plot grafik menggunakan titik sederhana untuk demonstrasi */
        .bg-num { position: absolute; font-size: 9px; color: #999; width: 20px; margin-left: -10px; margin-top: -5px; z-index: 0; text-align: center; line-height: 9px; }
        .plot-point { position: absolute; width: 8px; height: 8px; background-color: #000; border-radius: 50%; margin-left: -4px; margin-top: -4px; z-index: 2; }
        .plot-label { position: absolute; left: 12px; top: -8px; font-size: 11px; font-weight: bold; background: rgba(255,255,255,0.95); padding: 2px 4px; border-radius: 3px; border: 1px solid #aaa; z-index: 3;}
        .plot-line { position: absolute; border-top: 1px solid #000; transform-origin: left top; }
        
        .d-col { left: 20%; }
        .i-col { left: 40%; }
        .s-col { left: 60%; }
        .c-col { left: 80%; }
        
        .label-row { position: absolute; bottom: 15px; left: 0; width: 230px; font-weight: bold; font-size: 13px; }
        .label-d { position: absolute; left: 63px; width: 20px; margin-left: -10px; text-align: center; }
        .label-i { position: absolute; left: 101px; width: 20px; margin-left: -10px; text-align: center; }
        .label-s { position: absolute; left: 139px; width: 20px; margin-left: -10px; text-align: center; }
        .label-c { position: absolute; left: 177px; width: 20px; margin-left: -10px; text-align: center; }
        
        .clearfix::after { content: ""; clear: both; display: table; }

        /* Styles untuk Halaman 2 Hasil Keputusan */
        .page-break {
            page-break-before: always;
        }
        .result-card {
            border: 2px solid #000;
            padding: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        .result-title {
            font-size: 14px;
            font-weight: bold;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .personality-badge {
            display: inline-block;
            padding: 6px 15px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .desc-text {
            font-size: 12px;
            line-height: 1.6;
            text-align: justify;
        }
        .signature-section {
            margin-top: 40px;
            width: 100%;
        }
        .signature-table {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- BAGIAN HEADER -->
    <table class="header-table">
        <tr>
            <td width="30%" rowspan="5" style="text-align: center; vertical-align: middle;">
                <div class="title-box" style="font-size: 20px; line-height: 1.2;">{{ strtoupper(__('messages.psikotes')) }}</div>
                <div class="subtitle" style="font-size: 11px; font-weight: bold; margin-top: 5px;">{{ __('messages.personality_style_analysis') }}</div>
            </td>
            <td width="10%">{{ __('messages.name') }}:</td>
            <td width="25%" style="border-bottom: 1px solid #000;">{{ $biodata->nama_lengkap }}</td>
            <td width="10%">{{ __('messages.date') }}:</td>
            <td width="25%" style="border-bottom: 1px solid #000;">{{ \Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.education') }}:</td>
            <td style="border-bottom: 1px solid #000;">{{ $biodata->universitas }} ({{ $biodata->fakultas }})</td>
            <td>{{ __('messages.position') }}:</td>
            <td style="border-bottom: 1px solid #000;">{{ __('messages.intern_candidate') }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.organization') }}:</td>
            <td style="border-bottom: 1px solid #000;">EQUITYWORLD FUTURES</td>
            <td>{{ __('messages.gender') }}:</td>
            <td style="border-bottom: 1px solid #000;">{{ $biodata->jenis_kelamin == 'L' ? __('messages.male') : __('messages.female') }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.intern_duration') }}:</td>
            <td style="border-bottom: 1px solid #000;">{{ $biodata->durasi_magang != '-' ? $biodata->durasi_magang . ' ' : '' }}({{ \Carbon\Carbon::parse($biodata->mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($biodata->sampai)->format('d/m/Y') }})</td>
            <td>{{ __('messages.advisor') }}:</td>
            <td style="border-bottom: 1px solid #000;">{{ $biodata->pembimbing }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.address') }}:</td>
            <td colspan="3" style="border-bottom: 1px solid #000;">{{ $biodata->alamat }}</td>
        </tr>
    </table>

    <!-- BAGIAN SKOR -->
    <table class="score-box">
        <tr class="score-header" style="background-color: #ddd;">
            <th width="20%"></th>
            <th width="12%">D</th>
            <th width="12%">I</th>
            <th width="12%">S</th>
            <th width="12%">C</th>
            <th width="12%">*</th>
            <th width="20%">{{ __('messages.total_score') }}</th>
        </tr>
        <tr>
            <td style="background-color: #555; color: white; font-weight: bold;">MOST</td>
            <td>{{ $result->score_d_most }}</td>
            <td>{{ $result->score_i_most }}</td>
            <td>{{ $result->score_s_most }}</td>
            <td>{{ $result->score_c_most }}</td>
            <td>{{ $result->score_star_most }}</td>
            <td>{{ __('messages.must_equal_24') }}</td>
        </tr>
        <tr>
            <td style="background-color: #555; color: white; font-weight: bold;">LEAST</td>
            <td>{{ $result->score_d_least }}</td>
            <td>{{ $result->score_i_least }}</td>
            <td>{{ $result->score_s_least }}</td>
            <td>{{ $result->score_c_least }}</td>
            <td>{{ $result->score_star_least }}</td>
            <td>{{ __('messages.must_equal_24') }}</td>
        </tr>
        <tr>
            <td style="background-color: #555; color: white; font-weight: bold;">CHANGE</td>
            <td>{{ $result->score_d_change }}</td>
            <td>{{ $result->score_i_change }}</td>
            <td>{{ $result->score_s_change }}</td>
            <td>{{ $result->score_c_change }}</td>
            <td style="background-color: #ccc;"></td>
            <td style="background-color: #ccc;"></td>
        </tr>
    </table>



    @php
        function getBgArray() {
            static $bg = [
                'most' => [
                    'D' => [12=>'20', 11=>'16', 10=>'15', 8=>'14', 7=>'13', 6=>'12', 5=>'11', 4=>'10', 2=>'9', 1=>'8', 0=>'7', -1=>'6', -3=>'5', -4=>'4', -6=>'3', -8=>'2', -11=>'1', -12=>'0'],
                    'I' => [12=>'17', 11=>'10', 9=>'9', 7=>'7', 5=>'6', 4=>'5', 1=>'4', -3=>'3', -6=>'2', -10=>'1', -11=>'0'],
                    'S' => [12=>'19', 10=>'13', 8=>'11', 6=>'10', 4=>'8', 3=>'7', 1=>'6', 0=>'5', -2=>'4', -4=>'3', -7=>'2', -11=>'1', -12=>'0'],
                    'C' => [12=>'14', 10=>'10', 8=>'8', 7=>'7', 4=>'6', 2=>'5', 0=>'4', -2=>'3', -6=>'2', -10=>'1', -11=>'0']
                ],
                'least' => [
                    'D' => [12=>'0', 10=>'1', 7=>'2', 4=>'3', 2=>'4', 1=>'5', 0=>'6', -1=>'7', -2=>'8', -4=>'9', -5=>'10', -6=>'11', -8=>'12', -9=>'13', -10=>'14', -11=>'15', -12=>'18'],
                    'I' => [12=>'0', 10=>'1', 7=>'2', 4=>'3', 2=>'4', 0=>'5', -2=>'6', -4=>'7', -6=>'8', -8=>'9', -9=>'10', -10=>'11', -11=>'12', -12=>'15'],
                    'S' => [12=>'0', 10=>'1', 8=>'2', 7=>'3', 4=>'4', 2=>'5', 0=>'6', -2=>'7', -4=>'8', -6=>'9', -8=>'10', -9=>'11', -10=>'12', -11=>'13', -12=>'18'],
                    'C' => [12=>'0', 10=>'1', 7=>'2', 4=>'3', 2=>'4', 0=>'5', -1=>'6', -3=>'7', -5=>'8', -7=>'9', -9=>'10', -10=>'11', -11=>'12', -12=>'13']
                ],
                'change' => [
                    'D' => [12=>'20', 11=>'16', 10=>'15', 9=>'14', 8=>'13', 7=>'12', 6=>'10', 4=>'9', 3=>'8', 2=>'7', 0=>'5', -2=>'3', -3=>'1', -4=>'0', -5=>'-2', -6=>'-3', -7=>'-4', -8=>'-6', -9=>'-7', -10=>'-9', -11=>'-10', -12=>'-15'],
                    'I' => [12=>'17', 11=>'15', 9=>'8', 8=>'7', 7=>'6', 6=>'5', 4=>'4', 3=>'3', 2=>'2', 1=>'1', 0=>'0', -1=>'-1', -2=>'-2', -3=>'-3', -4=>'-4', -5=>'-5', -7=>'-6', -8=>'-7', -10=>'-8', -11=>'-12', -12=>'-13'],
                    'S' => [12=>'19', 11=>'15', 10=>'10', 9=>'9', 7=>'8', 6=>'7', 5=>'6', 4=>'5', 3=>'4', 2=>'3', 1=>'2', 0=>'1', -1=>'0', -2=>'-1', -3=>'-2', -4=>'-3', -5=>'-4', -6=>'-5', -8=>'-6', -9=>'-7', -10=>'-8', -11=>'-10', -12=>'-13'],
                    'C' => [12=>'14', 10=>'7', 8=>'4', 6=>'3', 5=>'2', 4=>'1', 3=>'0', 2=>'-1', 1=>'-2', 0=>'-3', -1=>'-4', -2=>'-5', -4=>'-6', -5=>'-7', -7=>'-8', -8=>'-9', -9=>'-10', -11=>'-13', -12=>'-15']
                ]
            ];
            return $bg;
        }
        $bg = getBgArray();

        function getMapArray() {
            static $map = [
                'most' => [
                    'D' => [20=>12,19=>11.5,18=>11.5,17=>11.5,16=>11,15=>10,14=>8,13=>7,12=>6,11=>5,10=>4,9=>2,8=>1,7=>0,6=>-1,5=>-3,4=>-4,3=>-6,2=>-8,1=>-11,0=>-12],
                    'I' => [17=>12,16=>11.5,15=>11.5,14=>11.5,13=>11.5,12=>11.5,11=>11.5,10=>11,9=>9,8=>8,7=>7,6=>5.5,5=>5,4=>4,3=>-3,2=>-6,1=>-10,0=>-11],
                    'S' => [19=>12,18=>11,17=>11,16=>11,15=>11,14=>11,13=>10,12=>9,11=>8,10=>6,9=>5,8=>4,7=>3,6=>1,5=>0,4=>-2,3=>-4,2=>-7,1=>-11,0=>-12],
                    'C' => [14=>12,13=>11,12=>11,11=>11,10=>10,9=>9,8=>8,7=>7,6=>4,5=>2,4=>0,3=>-2,2=>-6,1=>-10,0=>-11]
                ],
                'least' => [
                    'D' => [0=>12,1=>10,2=>7,3=>4,4=>2,5=>1,6=>0,7=>-1,8=>-2,9=>-4,10=>-5,11=>-6,12=>-8,13=>-9,14=>-10,15=>-11,16=>-12,17=>-12,18=>-12,19=>-12,20=>-12,21=>-12,22=>-12,23=>-12,24=>-12],
                    'I' => [0=>12,1=>11,2=>8,3=>6,4=>4,5=>0,6=>-2,7=>-3,8=>-5,9=>-6,10=>-8,11=>-9,12=>-10,13=>-12,14=>-12,15=>-12,16=>-12,17=>-12,18=>-12,19=>-12,20=>-12,21=>-12,22=>-12,23=>-12,24=>-12],
                    'S' => [0=>12,1=>11,2=>10,3=>8.5,4=>7.5,5=>4,6=>1,7=>-2,8=>-3,9=>-5,10=>-8,11=>-9,12=>-11,13=>-12,14=>-12,15=>-12,16=>-12,17=>-12,18=>-12,19=>-12,20=>-12,21=>-12,22=>-12,23=>-12,24=>-12],
                    'C' => [0=>12,1=>11,2=>9,3=>6,4=>4,5=>3,6=>1,7=>0,8=>-2,9=>-4,10=>-6,11=>-8,12=>-9,13=>-11,14=>-12,15=>-12,16=>-12,17=>-12,18=>-12,19=>-12,20=>-12,21=>-12,22=>-12,23=>-12,24=>-12]
                ]
            ];
            return $map;
        }

        function getPct($score, $type='most', $col='D') {
            $map = getMapArray();
            if (isset($map[$type][$col][$score])) {
                $row = $map[$type][$col][$score];
            } else {
                if ($type == 'change') {
                    $row = round($score / 2);
                } else {
                    $row = ($type == 'most') ? round(($score - 12) / 1) : round((12 - $score) / 1);
                }
            }
            $row = max(-12, min(12, $row));
            return ((12 - $row) / 24) * 100;
        }

        function getPlotLabel($score, $type, $col) {
            return '<span class="plot-label" style="color: black;">'.$score.'</span>';
        }

        // Pembantu untuk menggambar garis menggunakan CSS murni untuk kompatibilitas DomPDF
        function drawLine($x1_pct, $y1_pct, $x2_pct, $y2_pct) {
            $w = 190; // Lebar .graph-area
            $h = 380; // Tinggi .graph-area
            
            $x1 = ($x1_pct / 100) * $w;
            $y1 = ($y1_pct / 100) * $h;
            $x2 = ($x2_pct / 100) * $w;
            $y2 = ($y2_pct / 100) * $h;
            
            $length = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
            $angle = atan2($y2 - $y1, $x2 - $x1) * 180 / pi();
            
            $cx = ($x1 + $x2) / 2;
            $cy = ($y1 + $y2) / 2;
            
            $left = $cx - ($length / 2);
            $top = $cy - 0.5; // 0.5 untuk memusatkan garis setinggi 1px
            
            return "<div style='position:absolute; left:{$left}px; top:{$top}px; width:{$length}px; height:1px; background-color:#000; transform:rotate({$angle}deg); z-index:1;'></div>";
        }

        function drawMiniLine($x1, $y1, $x2, $y2) {
            $length = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
            $angle = atan2($y2 - $y1, $x2 - $x1) * 180 / pi();
            $cx = ($x1 + $x2) / 2;
            $cy = ($y1 + $y2) / 2;
            $left = $cx - ($length / 2);
            $top = $cy - 0.5;
            return "<div style='position:absolute; left:{$left}px; top:{$top}px; width:{$length}px; height:1px; background-color:#000; transform:rotate({$angle}deg); z-index:1;'></div>";
        }
    @endphp

    <!-- GRAFIK -->
    <div class="graphs-container clearfix">
        <!-- Grafik 1: MOST (Topeng) -->
        <div class="graph-wrapper">
            <div class="graph-title">{{ __('messages.graph') }} 1<br>{{ __('messages.mask') }}</div>
            <div class="graph-area">
                @for($i=12; $i>=-12; $i--)
                    @php $top = ((12 - $i) / 24) * 100; @endphp
                    @if(isset($bg['most']['D'][$i])) <div class="bg-num d-col" style="top:{{$top}}%;">{!! $bg['most']['D'][$i] !!}</div> @endif
                    @if(isset($bg['most']['I'][$i])) <div class="bg-num i-col" style="top:{{$top}}%;">{!! $bg['most']['I'][$i] !!}</div> @endif
                    @if(isset($bg['most']['S'][$i])) <div class="bg-num s-col" style="top:{{$top}}%;">{!! $bg['most']['S'][$i] !!}</div> @endif
                    @if(isset($bg['most']['C'][$i])) <div class="bg-num c-col" style="top:{{$top}}%;">{!! $bg['most']['C'][$i] !!}</div> @endif
                @endfor
                
                {!! drawLine(20, getPct($result->score_d_most, 'most', 'D'), 40, getPct($result->score_i_most, 'most', 'I')) !!}
                {!! drawLine(40, getPct($result->score_i_most, 'most', 'I'), 60, getPct($result->score_s_most, 'most', 'S')) !!}
                {!! drawLine(60, getPct($result->score_s_most, 'most', 'S'), 80, getPct($result->score_c_most, 'most', 'C')) !!}
                <div class="plot-point d-col" style="top: {{ getPct($result->score_d_most, 'most', 'D') }}%;">{!! getPlotLabel($result->score_d_most, 'most', 'D') !!}</div>
                <div class="plot-point i-col" style="top: {{ getPct($result->score_i_most, 'most', 'I') }}%;">{!! getPlotLabel($result->score_i_most, 'most', 'I') !!}</div>
                <div class="plot-point s-col" style="top: {{ getPct($result->score_s_most, 'most', 'S') }}%;">{!! getPlotLabel($result->score_s_most, 'most', 'S') !!}</div>
                <div class="plot-point c-col" style="top: {{ getPct($result->score_c_most, 'most', 'C') }}%;">{!! getPlotLabel($result->score_c_most, 'most', 'C') !!}</div>
            </div>
            <div class="label-row">
                <span class="label-d">D</span><span class="label-i">I</span><span class="label-s">S</span><span class="label-c">C</span>
            </div>
        </div>

        <!-- Grafik 2: LEAST (Tekanan) -->
        <div class="graph-wrapper">
            <div class="graph-title">{{ __('messages.graph') }} 2<br>{{ __('messages.pressure') }}</div>
            <div class="graph-area">
                @for($i=12; $i>=-12; $i--)
                    @php $top = ((12 - $i) / 24) * 100; @endphp
                    @if(isset($bg['least']['D'][$i])) <div class="bg-num d-col" style="top:{{$top}}%;">{!! $bg['least']['D'][$i] !!}</div> @endif
                    @if(isset($bg['least']['I'][$i])) <div class="bg-num i-col" style="top:{{$top}}%;">{!! $bg['least']['I'][$i] !!}</div> @endif
                    @if(isset($bg['least']['S'][$i])) <div class="bg-num s-col" style="top:{{$top}}%;">{!! $bg['least']['S'][$i] !!}</div> @endif
                    @if(isset($bg['least']['C'][$i])) <div class="bg-num c-col" style="top:{{$top}}%;">{!! $bg['least']['C'][$i] !!}</div> @endif
                @endfor
                
                {!! drawLine(20, getPct($result->score_d_least, 'least', 'D'), 40, getPct($result->score_i_least, 'least', 'I')) !!}
                {!! drawLine(40, getPct($result->score_i_least, 'least', 'I'), 60, getPct($result->score_s_least, 'least', 'S')) !!}
                {!! drawLine(60, getPct($result->score_s_least, 'least', 'S'), 80, getPct($result->score_c_least, 'least', 'C')) !!}
                <div class="plot-point d-col" style="top: {{ getPct($result->score_d_least, 'least', 'D') }}%;">{!! getPlotLabel($result->score_d_least, 'least', 'D') !!}</div>
                <div class="plot-point i-col" style="top: {{ getPct($result->score_i_least, 'least', 'I') }}%;">{!! getPlotLabel($result->score_i_least, 'least', 'I') !!}</div>
                <div class="plot-point s-col" style="top: {{ getPct($result->score_s_least, 'least', 'S') }}%;">{!! getPlotLabel($result->score_s_least, 'least', 'S') !!}</div>
                <div class="plot-point c-col" style="top: {{ getPct($result->score_c_least, 'least', 'C') }}%;">{!! getPlotLabel($result->score_c_least, 'least', 'C') !!}</div>
            </div>
            <div class="label-row">
                <span class="label-d">D</span><span class="label-i">I</span><span class="label-s">S</span><span class="label-c">C</span>
            </div>
        </div>

        <!-- Grafik 3: CHANGE (Diri Sendiri) -->
        <div class="graph-wrapper">
            <div class="graph-title">{{ __('messages.graph') }} 3<br>{{ __('messages.self') }}</div>
            <div class="graph-area">
                @for($i=12; $i>=-12; $i--)
                    @php $top = ((12 - $i) / 24) * 100; @endphp
                    @if(isset($bg['change']['D'][$i])) <div class="bg-num d-col" style="top:{{$top}}%;">{!! $bg['change']['D'][$i] !!}</div> @endif
                    @if(isset($bg['change']['I'][$i])) <div class="bg-num i-col" style="top:{{$top}}%;">{!! $bg['change']['I'][$i] !!}</div> @endif
                    @if(isset($bg['change']['S'][$i])) <div class="bg-num s-col" style="top:{{$top}}%;">{!! $bg['change']['S'][$i] !!}</div> @endif
                    @if(isset($bg['change']['C'][$i])) <div class="bg-num c-col" style="top:{{$top}}%;">{!! $bg['change']['C'][$i] !!}</div> @endif
                @endfor
                
                <!-- Garis 0 untuk Change -->
                <div style="position:absolute; width:100%; border-top:1px dashed #000; top: 50%; z-index:0;"></div>
                
                {!! drawLine(20, getPct($result->score_d_change, 'change', 'D'), 40, getPct($result->score_i_change, 'change', 'I')) !!}
                {!! drawLine(40, getPct($result->score_i_change, 'change', 'I'), 60, getPct($result->score_s_change, 'change', 'S')) !!}
                {!! drawLine(60, getPct($result->score_s_change, 'change', 'S'), 80, getPct($result->score_c_change, 'change', 'C')) !!}
                
                <div class="plot-point d-col" style="top: {{ getPct($result->score_d_change, 'change', 'D') }}%;">{!! getPlotLabel($result->score_d_change, 'change', 'D') !!}</div>
                <div class="plot-point i-col" style="top: {{ getPct($result->score_i_change, 'change', 'I') }}%;">{!! getPlotLabel($result->score_i_change, 'change', 'I') !!}</div>
                <div class="plot-point s-col" style="top: {{ getPct($result->score_s_change, 'change', 'S') }}%;">{!! getPlotLabel($result->score_s_change, 'change', 'S') !!}</div>
                <div class="plot-point c-col" style="top: {{ getPct($result->score_c_change, 'change', 'C') }}%;">{!! getPlotLabel($result->score_c_change, 'change', 'C') !!}</div>
            </div>
            <div class="label-row">
                <span class="label-d">D</span><span class="label-i">I</span><span class="label-s">S</span><span class="label-c">C</span>
            </div>
        </div>
    </div>

    <!-- PENJELASAN POLA GRAFIK -->
    <div style="margin-top: 15px; border: 1px solid #000000; padding: 8px; background-color: #ffffff; width: 100%;">
        <div style="font-weight: bold; font-size: 10px; margin-bottom: 6px; border-bottom: 1px solid #000000; padding-bottom: 2px; text-transform: uppercase;">
            Penjelasan Pola Grafik
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <!-- Pola 2 (Mountain-shape) -->
                <td width="50%" style="vertical-align: top; padding-right: 10px; border-right: 1px dashed #000000;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td width="65" style="vertical-align: top;">
                                <div style="position: relative; width: 60px; height: 50px; border: 1px solid #000000; background-color: #ffffff;">
                                    {!! drawMiniLine(10, 40, 25, 25) !!}
                                    {!! drawMiniLine(25, 25, 40, 10) !!}
                                    {!! drawMiniLine(40, 10, 50, 30) !!}
                                    <div style="position: absolute; left: 10px; top: 40px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                    <div style="position: absolute; left: 25px; top: 25px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                    <div style="position: absolute; left: 40px; top: 10px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                    <div style="position: absolute; left: 50px; top: 30px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                </div>
                            </td>
                            <td style="vertical-align: top; font-size: 9px; line-height: 1.4; padding-left: 5px;">
                                Jika grafik terbentuk pola seperti di samping, kemungkinan besar pelamar <strong>akan masuk</strong> ke tahap selanjutnya.
                            </td>
                        </tr>
                    </table>
                </td>
                
                <!-- Pola 1 (V-shape) -->
                <td width="50%" style="vertical-align: top; padding-left: 10px;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td width="65" style="vertical-align: top;">
                                <div style="position: relative; width: 60px; height: 50px; border: 1px solid #000000; background-color: #ffffff;">
                                    {!! drawMiniLine(10, 10, 25, 25) !!}
                                    {!! drawMiniLine(25, 25, 40, 45) !!}
                                    {!! drawMiniLine(40, 45, 50, 15) !!}
                                    <div style="position: absolute; left: 10px; top: 10px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                    <div style="position: absolute; left: 25px; top: 25px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                    <div style="position: absolute; left: 40px; top: 45px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                    <div style="position: absolute; left: 50px; top: 15px; width: 4px; height: 4px; background-color: #000000; border-radius: 50%; margin-left: -2px; margin-top: -2px; z-index: 2;"></div>
                                </div>
                            </td>
                            <td style="vertical-align: top; font-size: 9px; line-height: 1.4; padding-left: 5px;">
                                Jika grafik terbentuk pola seperti di samping, kemungkinan besar pelamar <strong>belum tentu masuk</strong> ke tahap selanjutnya.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    
    <div style="margin-top: 10px; font-size: 9px; text-align: right; color: #555; margin-bottom: 10px;">
        <em>Generated by Sistem Informasi SDM - EQUITYWORLD FUTURES</em>
    </div>

    <!-- HALAMAN 2: HASIL KEPUTUSAN & PENJELASAN KEPRIBADIAN -->
    <div class="page-break"></div>
    
    @php
        $dominant = $result->getDominantProfile();
        $profiles = [
            'D' => [
                'letter' => 'D',
                'name' => __('messages.dominance_name'),
                'desc' => __('messages.dominance_desc'),
                'color' => '#dc3545'
            ],
            'I' => [
                'letter' => 'I',
                'name' => __('messages.influence_name'),
                'desc' => __('messages.influence_desc'),
                'color' => '#ffc107'
            ],
            'S' => [
                'letter' => 'S',
                'name' => __('messages.steadiness_name'),
                'desc' => __('messages.steadiness_desc'),
                'color' => '#198754'
            ],
            'C' => [
                'letter' => 'C',
                'name' => __('messages.compliance_name'),
                'desc' => __('messages.compliance_desc'),
                'color' => '#0dcaf0'
            ]
        ];
    @endphp

    <table class="header-table" style="margin-bottom: 15px;">
        <tr>
            <td width="100%" style="text-align: center; padding: 8px 0;">
                <div style="font-size: 16px; font-weight: bold; letter-spacing: 1px;">{{ strtoupper(__('messages.test_decision')) }}</div>
                <div style="font-size: 10px; margin-top: 4px;">{{ __('messages.full_name') }}: <strong>{{ $biodata->nama_lengkap }}</strong> | {{ __('messages.date') }}: <strong>{{ \Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}</strong></div>
            </td>
        </tr>
    </table>

    <div class="result-card" style="border-color: #000000; background-color: #ffffff; padding: 12px; margin-top: 10px;">
        <div class="result-title" style="border-bottom: 2px solid #000000; padding-bottom: 4px; margin-bottom: 12px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
            Tipe Kepribadian & Karakteristik
        </div>
        
        @foreach($profiles as $key => $profile)
            @php
                $isActive = ($key === $dominant);
                $color = $isActive ? $profile['color'] : '#999999';
                $badgeBg = $isActive ? $profile['color'] : '#e0e0e0';
                $badgeText = $isActive ? '#ffffff' : '#666666';
                $textColor = $isActive ? '#000000' : '#777777';
                $fontWeight = $isActive ? 'bold' : 'normal';
            @endphp
            
            <div style="margin-bottom: 15px; @if(!$loop->last) border-bottom: 1px dashed #dddddd; padding-bottom: 12px; @endif">
                <div style="font-size: 12px; margin-bottom: 6px; color: {{ $textColor }}; font-weight: {{ $fontWeight }};">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $badgeBg }}; color: {{ $badgeText }}; text-align: center; line-height: 20px; font-weight: bold; border-radius: 4px; font-size: 11px; margin-right: 8px;">
                        {{ $profile['letter'] }}
                    </span>
                    <span style="vertical-align: middle; font-size: 12px; font-weight: bold; color: {{ $isActive ? $profile['color'] : '#666666' }};">
                        {{ $profile['name'] }}
                    </span>
                </div>
                <div style="font-size: 10.5px; line-height: 1.4; text-align: justify; color: {{ $textColor }}; padding-left: 28px;">
                    {{ $profile['desc'] }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td width="50%" style="text-align: left; vertical-align: top;">
                    <div style="font-size: 9px; color: #777; width: 85%; line-height: 1.4; padding-top: 20px;">
                        * {{ __('messages.signature_notice') }}
                    </div>
                </td>
                <td width="50%" style="text-align: center; vertical-align: top;">
                    <div style="font-size: 12px; font-weight: bold; margin-bottom: 55px;">
                        {{ __('messages.hr_department') }}
                    </div>
                    <div style="border-bottom: 1px solid #000; width: 180px; margin: 0 auto;"></div>
                    <div style="font-size: 11px; margin-top: 5px; font-weight: bold;">EQUITYWORLD FUTURES</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
