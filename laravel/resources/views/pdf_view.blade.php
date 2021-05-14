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
    <div class='code'>Reģ. kods: <b>{{$app->cipher}}</b></div>
    <div class='header'><h2>Profesionālās izglītības kompetences centra</h2><h3>Rīgas Valsts tehnikuma direktorei</h3></div>
    <div class='author1'>{{$app->name}} {{$app->surname}}</div>
    <div class='author2'><sup>(vārds uzvārds)</sup></div>
    <div  class='author1'><b>{{ $app->personal_code }}</b></div>
    <div class='author2'><sup>(personas kods)</sup></div>
    <div class='author1'>{{$app->home}}</div>
    <div class='author2'><sup>(iela, mājas Nr. dzīvokļa Nr., ciems, pagasts, pilsēta, reģions, pasta kods)</sup></div>
    <div class='address'>{{$app->telephone}}, {{$app->email}}</div>
    <div class='author2'><sup>(Tālruņa numurs, epasts)</sup></div>
    <div class='header'><h3><i>iesniegums</i></h3></div>
    <div>Lūdzu pieņemt mani specialitātē:  <b>{{$app->speciality->speciality}}</b> <b>{{$app->speciality->name}}</b></div>
    <div>Par sevi sniedzu šādas ziņas:</div>
    <div>Izglītība: <span class='info'>{{$app->education}}, {{$app->education_name}}, {{$app->year}}. gads</span></div>
    <div>Izglītība kods: <span class='info'>{{$app->education_code}}</span></div>
    <div><b>Galīgie vērtējumi:</b></div>
    <table>
    <tr><td class='subject'>Matemātika:</td>
        <td><b class='info2'>{{$marks->math}}</b></td
        ><td class='subject'>Latviešu valoda:</td>
        <td><b class='info2'>{{ $marks->latvian  }}</b></td>
        <td class='subject'>Ķīmija:</td>
        <td><b class='info2'>{{$marks->chemistry}}</b>
        @if(property_exists($marks, 'informatics') && $marks->informatics != null)
        </td><td class='subject'>Informātika:</td>
        <td ><b class='info2' > {{ $marks->informatics }}</b ></td>
        @endif
    </tr>
        <tr>
            <td class='subject'>1. svešvaloda ({{ $marks->trans_language }}):</td>
            <td><b  class='info2'>{{$marks->language_mark}}</b></td>
            <td class='subject'>Fizika:</td>
            <td><b class='info2'>{{ $marks->physics }}</b></td>
        </tr>
    </table>
    <div>Galīgo vērtējumu vidējā atzīme: <b>{{$marks->avg}}</b> balles</div>
    <div><b>Radinieka dati (vārds, uzvārds, tālrunis, e-pasts):</b></div>

    @if(property_exists($relatives, 'mom'))
        <div>Māte:
            <span class='info'>{{$relatives->mom->name}} {{$relatives->mom->surname}}
                <span style='text-transform:lowercase'></span>
                {{$relatives->mom->telephone}}
                <span style='text-transform:lowercase'>{{$relatives->mom->email}}</span>
            </span>
        </div>
    @endif

    @if(property_exists($relatives, 'father'))
        <div>Tēvs:
            <span class='info'>{{$relatives->father->name}} {{$relatives->father->surname}}
                <span style='text-transform:lowercase'></span>
                {{$relatives->father->telephone}}
                <span style='text-transform:lowercase'>{{$relatives->father->email}}</span>
            </span>
        </div>
    @endif

    @if(property_exists($relatives, 'guardian'))
        <div>Aizbildnis:
            <span class='info'>{{$relatives->guardian->name}} {{$relatives->guardian->surname}}
                <span style='text-transform:lowercase'></span>
                <br/>{{$relatives->guardian->telephone}}<br/>
                <span style='text-transform:lowercase'>{{$relatives->guardian->email}}</span>
            </span>
        </div>
    @endif

    <div><b>Papildinformācija:</b></div>
    <table>
        <tr>
            <td class='info1'>Dienesta viesnīca:</td>
            <td class='info2'>
                <b>{{$info->hostel == 'yes' ? 'Jā' : 'Nē'}}</b>
            </td>
            <td class='info1'>Esmu bārenis jā/nē:&nbsp;</td>
            <td class='info2'>
                <b>{{$info->children == 'yes' ? 'Jā' : 'Nē'}}</b>
            </td>
        </tr>
        <tr>
            <td class='info1'>Esmu persona ar <br/>speciālām vajadzībām:</td>
            <td class='info2'>
                <b>{{$info->special == 'yes' ? 'Jā' : 'Nē'}}</b>&nbsp;
            </td>
            <td class='info1'>Esmu no daudzbērnu<br/> ģimenes jā/nē:</td>
            <td class='info2'>
                <b>{{$info->family == 'yes' ? 'Jā' : 'Nē'}}</b>
            </td>
        </tr>
    </table><br/>
    <div>Saskaņā ar uzņemšanas noteikumiem, pievienoju šādus dokumentus:</div>
    <div>
        <ul>
            <li>izglītības dokuments (kopija);</li>
            <li>izziņa par veselības stāvokli (veidlapa Nr. 027/u);</li>
            <li>4 fotogrāfijas (3x4 cm)</li>
            <li>citi:_______</li>
        </ul>
    </div>
    <div class='date'>Datums: {{date("d.m.Y")}}</div>
    <div class='date'>Apliecinu, ka sniegtās ziņas ir patiesas: _______________<br/><sup>(paraksts)</sup></div>

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
