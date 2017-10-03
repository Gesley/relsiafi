<html>
<head>
    <meta charset="utf-8" />
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
        <h4>1 - RELATÓRIO EXTRAÇÃO DE DADOS SIAFI OPERACIONAL</h4>
        <p>Período de Faturamento: {{ mb_strtoupper($opcoes['mes_relativo']['month']['desc']) }}/{{$opcoes['mes_relativo']['year'] }}</p>
        <br />
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th rowspan="3">DESCRIÇÃO DO SERVIÇO</th>
                <th rowspan="3">REFERÊNCIA</th>
                <th rowspan="3">PERÍODO DE REFERÊNCIA DO SERVIÇO</th>
                <th>TABELA DE FRANQUIA</th>
                <th>VOLUME REALIZADO</th>
                <th>VOLUME FATURADO</th>
                <th>VALOR UNITÁRIO</th>
                <th rowspan="2">VALOR A FATURAR (R$)</th>
            </tr>
            <tr>
                <th>MILHEIRO DE REGISTROS</th>
                <th>MILHEIRO DE REGISTROS</th>
                <th>MILHEIRO DE REGISTROS</th>
                <th>R$</th>
            </tr>
            <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>F</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repository['data'] as $movimentacao)
            <tr>
                <td>EXTRAÇÃO DA CARGA INCREMENTAL SIAFI OPERACIONAL</td>
                <td class="destaque">{{ mb_strtoupper($opcoes['mes_relativo']['month']['desc']) }}/{{$opcoes['mes_relativo']['year'] }}</td>
                <td>{{ $movimentacao['inicial'] }} a {{ $movimentacao['final']}}</td>
                <td>{{ Format::number($movimentacao['franquia']) }}</td>
                <td>{{ Format::number($movimentacao['milheiros']) }}</td>
                <td>{{ Format::number($movimentacao['franquia']) }}</td>
                <td>{{ $movimentacao['valor_unidade'] }}</td>
                <td>{{ Format::number($movimentacao['valor_faturado']) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7" class="destaque">VALOR TOTAL A FATURAR</td>
                <td class="destaque">{{ Format::number($repository['total']) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
