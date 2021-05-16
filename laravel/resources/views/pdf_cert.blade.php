<html lang="lv">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body>
<div class='header'><b>Profesionālās izglītības kompetences centra</b><h3>Rīgas Valsts tehnikums</h3></div>
<div>Par dokumentu pieņemšanu un izsniegšanu Nr. <b>{{$app->cipher}}</b></div>
<div class='author1'>{{$app->name}} {{$app->surname}}</div>
<div class='author2'><sup>(vārds uzvārds)</sup></div>
<div>iesniedza dokumentus:</div>
<ol>
    <li>Iesniegums &#9723;</li>
    <li>Izglītības dokuments:<br/> &#9723; orģināls <br/> &#9723; kopijas</li>
    <li>______________ fotokartiņas 3 x 4 cm ar uzrakstu katrā otrā pusē (vārds, uzvārds, šifrs)</li>
    <li>Izziņa par veselības stāvokli (veidlapa Nr. 027/u) &#9723;</li>
    <li>Raksturojums &#9723;</li>
    <li>Citi dokumenti ______________</li>
    <li>______________</li>
</ol>
<div><b>Dokumentus pieņēma</b> ____________________________</div>
<div class='author2'><sup>(vārds uzvārds)</sup></div>
<div><b>Dokumentus iesniedza</b>  ____________________________</div>
<div class='author2'><sup>(paraksts)</sup></div>
<div><b>Dokumentus saņēmu</b>  ____________________________</div>
<div class='author2'><sup>(paraksts, datums)</sup></div>
<div class='author4'>Saņemot vai papildinot iesniegtos dokumentus, obligāti ir jāuzrāda APLIECINĀJUMS.</div>
</body>
</html>

<style>
    .header{
        text-align: center;
        font-family: 'Times New Roman';
        font-size:12px;
    }

    .author1{
        text-align: center;
        text-decoration: underline;
        text-transform: uppercase;
        font-weight: bold;
        font-family: 'Times New Roman', Georgia, Serif;
        font-size:13px;
    }

    .author2{
        text-align: center;
        font-family: 'Times New Roman', Georgia, Serif;
        font-size:13px;

    }

    .address{
        text-align: center;
        text-decoration: underline;
        font-weight: bold;
        font-family: 'Times New Roman', Georgia, Serif;

    }

    .info{
        font-family: 'Times New Roman', Georgia, Serif;
        text-transform: uppercase;
        font-weight: bold;


    }

    i{
        font-family: 'Times New Roman', Georgia, Serif;

    }

    div, tr, td, span{
        font-family: 'Times New Roman', Georgia, Serif;
        font-size:13px;

    }

    .subject{
        text-align: right;

    }

    .code{
        text-align: right;

    }

    div{
        line-height: 160%;

    }

    .date{
        text-align: right;

    }

    .author2{
        line-height: 0;

    }

    .author4{
        text-align: center;
        font-weight: bold;

    }


    .table {
        border-collapse: collapse;
        margin: auto;
        width: 400px;
    }


    .table, .th, .td {
        border: 1px solid black;

    }

    .info1{

    }

    .info2{
        font-weight: bold;

    }
</style>
