<html>
<head>
    <meta charset="UTF-8" />
    <style>
        table {
            font-size: 11pt;
            width: 100%;
            display:table;
            border-collapse: collapse;
        }
        tr {
            display:table-row;
            border: 1px solid Black;
            page-break-inside: avoid;
        }
        th{
            border: 1px solid Black;
            display:table-cell;
            background-color: #ccc;
        }
        td{
            border: 1px solid Black;
            display:table-cell;
            text-align: center;
        }
    </style>
</head>>

<body>
    @if($opcoes['id_formato'] == 1)
        <h4>MINISTÉRIO DA INTEGRAÇÃO NACIONAL</h4>
        <p>CONTRATO RG Nº {{ $contrato->strnumero }} </p>
        <p>Vigência: {{ $vigencia['inicio']}} a {{ $vigencia['fim'] }}</p>

        <h4>3.1 - RELATÓRIO CONSOLIDADO DAS EXTRAÇÕES DE DADOS SIAFI OPERACIONAL</h4>
        <p>Período de Faturamento: {{ mb_strtoupper($opcoes['mes_relativo']['month']['desc']) }}/{{$opcoes['mes_relativo']['year'] }}</p>
        <br />
    @endif
    <table>
        <thead>
            <tr>
                <th colspan="2">REGISTROS EXTRAÍDOS = D-1</th>
                <th colspan="{{count($repository['extracoes'])}}">ROTINA DE EXTRAÇÃO DE ARQUIVOS SIAFI OPERACIONAL</th>
                <th>TOTAIS</th>
            </tr>
            <tr>
                <th rowspan="2">DATA RECEBIMENTO DO ARQUIVO</th>
                <th rowspan="2">DATA MOVIMENTO DO ARQUIVO</th>
                @foreach($repository['extracoes'] as $extracao)
                    <th>{{ $extracao }}</th>
                @endforeach
                <th rowspan="2">GRAVADOS</th>
            </tr>
            <tr>
                <th>GRAVADOS</th>
                <th>GRAVADOS</th>
                <th>GRAVADOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repository['data'] as $periodo => $valores)
                @foreach($valores['data'] as $timestamp => $valor)
                <tr>
                    <td>{{ \Date::createFromTimestamp($valor['recebido'])->format('d/m/Y') }}</td>
                    <td>{{ \Date::createFromTimestamp($valor['movimento'])->format('d/m/Y') }}</td>
                    @foreach($valor['linhas'] as $linhas)
                        <td>{{ Format::number($linhas, 2) }}</td>
                    @endforeach
                    <td>{{ Format::number(array_sum($valor['linhas']), 2)}}</td>
                </tr>
                @endforeach
            @endforeach
            <tr>
                <th colspan="2">TOTAL DE REGISTROS</th>
                @foreach($repository['total']['extracao'] as $extracao)
                    <td>{{ Format::number($extracao, 2) }}</td>
                @endforeach
                <td>{{ Format::number(array_sum($repository['total']['extracao']), 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
