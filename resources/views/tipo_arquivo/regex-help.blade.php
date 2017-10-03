<h3>Meta-sequênciadores</h3>
<dl class="dl-horizontal">
    <dt>\w</dt>
    <dd>Extrai da string um caractere alfanumérico;</dd>

    <dt>\W</dt>
    <dd>Extrai da string um caracter não numeral inteiro (negação de \w);</dd>

    <dt>\d</dt>
    <dd>Extrai da string um numeral inteiro;</dd>

    <dt>\D</dt>
    <dd>Extrai da string um caracter não numeral inteiro negação de \d);</dd>

    <dt>\s</dt>
    <dd>Extrai da string um caracter de controle (espaços, tabulações[\t]).</dd>
</dl>

<h3>Quantificadores</h3>
<dl class="dl-horizontal">
    <dt>(x)?</dt>
    <dd>Quantificador que permite zero (0) ou uma (1), ocorrências da expressão anterior;</dd>

    <dt>(x)*</dt>
    <dd>Quantificador que permite zero ou mais ocorrências da expressão anterior;</dd>

    <dt>(x)+</dt>
    <dd>Quantificador que permite uma ou mais ocorrências da expressão anterior;</dd>

    <dt>(X){Y}</dt>
    <dd>Quantificador que permite um número específico de ocorrências da expressão anterior;</dd>

    <dt>(X){Y, }</dt>
    <dd>Quantificador que permite quatro ou mais ocorrências da expressão anterior;</dd>

    <dt>(X){Y,Z}</dt>
    <dd>Quantificador que permite entre Y a Z ocorrências da expressão anterior.</dd>
</dl>

<h3>Meta-caracteres</h3>
<dl class="dl-horizontal">
    <dt>(expressão)</dt>
    <dd>Meta-caracter que associará a expressão interna a um grupo;</dd>

    <dt>(&lt;nome&gt;expressao)</dt>
    <dd>Meta-caracter que associará a expressão interna a um grupo nomeado;</dd>

    <dt>[x]</dt>
    <dd>Meta-caracter que associará a expressão interna a uma lista de caracteres permitidos;</dd>

    <dt>[^x]</dt>
    <dd>Meta-caracter que associará a expressão interna a uma lista de caracteres não permitidos.</dd>
</dl>

<h3>Referenciadores posicionais</h3>
<dl class="dl-horizontal">
    <dt>\b</dt>
    <dd>Extrai da expressão um caractere de borda da palavra;</dd>

    <dt>^</dt>
    <dd>(Fora de uma lista) Associa a expressão ao início de uma linha</dd>

    <dt>$</dt>
    <dd>Associa a expressão ao fim de uma linha.</dd>
</dl>

<h3>Padrão POSIX</h3>
<dl class="dl-horizontal">
    <dt>[[:alnum:]]</dt>
    <dd>Extrair da string somente caracteres alfanuméricos;</dd>

    <dt>[[:alpha:]]</dt>
    <dd>Extrair da string somente caracteres que sejam letras;</dd>

    <dt>[[:blank:]]</dt>
    <dd>Extrair da string somente caracteres que sejam espaços ou tabulações.</dd>
</dl>
