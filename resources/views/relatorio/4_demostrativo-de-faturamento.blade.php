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

        <h4>4 - RELATÓRIO DEMOSTRATIVO DE FATURAMENTO - MINISTÉRIO DA INTEGRAÇÃO NACIONAL</h4>
        <br />
    @endif
    <table width="100%">
        <thead>
            <tr>
                <th colspan="16">DEMOSTRATIVO DE FATURAMENTO - MINISTÉRIO DA INTEGRAÇÃO NACIONAL</th>
            </tr>
            <tr>
                <th>CONTRATO</th>
                <th>ANO</th>
                @foreach($repository['date'] as $data)
                <th>{{ $data['mescurto'] }}</th>
                @endforeach
                <th>TOTAL</th>
                <th>Valor Executado do Contrato</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $contrato->strnumero }}</td>
                <td>2015</td>
                @foreach($repository['data'] as $valor)
                <td>{{ Format::number($valor['linhas'], 2) }}</td>
                @endforeach
                <td>{{ Format::number($repository['total']['ano'], 2) }}</td>
                <td>{{ Format::number($repository['total']['ano'],2) }}</td>
            </tr>

            <tr>
                <td colspan="15">TOTAL GERAL FATURADO CONTRATO {{ $contrato->strnumero }}</td>
                <td>{{ Format::number($repository['total']['ano'], 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
