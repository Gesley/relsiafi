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

        <h4>3 - RELATÓRIO CONSOLIDADO DAS EXTRAÇÕES DE DADOS SIAFI OPERACIONAL</h4>
        <p>Período de Faturamento: {{ mb_strtoupper($opcoes['mes_relativo']['month']['desc']) }}/{{$opcoes['mes_relativo']['year'] }}<?php ; ?></p>
        <br />
    @endif
    <table>
        <thead>
            <tr>
                <th colspan="{{ count($repository['date']) + 2 }}">RELATÓRIO CONSOLIDADO DAS EXTRAÇÕES DE DADOS SIAFI OPERACIONAL</th>
            </tr>
            <tr>
                <th>ARQUIVO EXTRAÍDO</th>
                @foreach($repository['date'] as $chave => $valor)
                <th>{{$valor['mescurto_ano']}}</th>
                @endforeach
                <th>Total de Registros</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repository['data'] as $chave => $valor)
                <tr>
                    <td>{{$valor['extracao']}}</td>

                    @foreach($valor['data'] as $valores)
                        <td>{{ Format::number($valores['milheiros'], 2) }}</td>
                    @endforeach

                    <td>{{Format::number($valor['total']['geral'],2)}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="{{ count($repository['date']) + 1 }}">TOTAL DE MILHEIROS DE REGISTROS EXTRAÍDOS - CARGA DIÁRIA</td>
                <td>{{ Format::number($repository['total']['geral'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="{{ count($repository['date']) + 1 }}">TOTAL GERAL DE MILHEIROS DE REGISTROS EXTRAÍDOS</td>
                <td>{{ Format::number($repository['total']['milheiros'], 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
