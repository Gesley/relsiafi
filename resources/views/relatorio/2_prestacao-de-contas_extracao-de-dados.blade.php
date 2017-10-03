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
</head>

<body>
    @if($opcoes['id_formato'] == 1)
        <h4>MINISTÉRIO DA INTEGRAÇÃO NACIONAL</h4>
        <p>CONTRATO RG Nº {{ $contrato->strnumero }} </p>
        <p>Vigência: {{ $vigencia['inicio']}} a {{ $vigencia['fim'] }}</p>

        <h4>2 - RELATÓRIO DE PRESTAÇÃO DE CONTAS - EXTRAÇÃO DE DADOS SIAFI OPERACIONAL</h4>
        <p>Demostrativo da Franquia Contratada e o Total de Milheiros de Registros Extraídos - SIAFI OPERACIONAL</p>
        <p>Período de Faturamento: {{ mb_strtoupper($opcoes['mes_relativo']['month']['desc']) }}/{{$opcoes['mes_relativo']['year'] }}<?php ; ?></p>
        <br />
    @endif
    <table>
        <thead>
            <tr>
                <th rowspan="2">MÊS/ANO</th>
                <th rowspan="2">PERÍODO</th>
                <th>Número de Novos Milheiros de Registros Previstos</th>
                <th>Número de Milheiros de Registros Acumulados</th>
                <th>VALOR ESTIMADO MENSAL</th>
                <th>VALOR ESTIMADO ACUMULADO</th>
                <th colspan="2">Número de Milheiros de Registros REALIZADOS</th>
                <th colspan="2">VALOR FATURADO (R$)</th>
            </tr>
            <tr>
                <th>FRANQUIA MENSAL</th>
                <th>FRANQUIA ACUMULADA</th>
                <th>R$ 5,56</th>
                <th>R$ 5,56</th>
                <th>NO MÊS</th>
                <th>ATÉ O MÊS</th>
                <th>NO MÊS</th>
                <th>ATÉ O MÊS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repository as $month => $valor)
                <tr>
                    <td>{{ $valor['meslongo_ano'] }}</td>
                    <td>{{ $valor['mes_contratado'] }}º MÊS CONTRATADO</td>
                    <td>{{ Format::number($valor['franquia'], 2) }}</td>
                    <td>{{ Format::number($valor['acumulado']['franquia'], 2) }}</td>
                    <td>{{ Format::number($valor['valor_estimado'], 2)  }}</td>
                    <td>{{ Format::number($valor['acumulado']['valor_estimado'], 2)  }}</td>
                    <td>{{ Format::number($valor['linhas'], 2)  }}</td>
                    <td>{{ Format::number($valor['acumulado']['linhas'], 2)  }}</td>
                    <td>{{ Format::number($valor['valor_faturado'], 2)  }}</td>
                    <td>{{ Format::number($valor['acumulado']['valor_faturado'], 2)  }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" align="center">TOTAL</td>
                <td>{{ Format::number(end($repository)['acumulado']['franquia'], 2) }}</td>
                <td colspan="3"></td>
                <td>{{ Format::number(end($repository)['acumulado']['linhas'], 2) }}</td>
                <td>{{ Format::number(end($repository)['acumulado']['linhas'], 2) }}</td>
                <td>{{ Format::number(end($repository)['acumulado']['valor_faturado'], 2) }}</td>
                <td>{{ Format::number(end($repository)['acumulado']['valor_faturado'], 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
