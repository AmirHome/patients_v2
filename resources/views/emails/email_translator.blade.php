<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmeda Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            background-color: #ffffff;
            
        }

        .header {
            background-color: #009ddc;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            border: 1px solid #009ddc;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .header img {
            width: auto;
                    
            
        }

        .content {
            padding: 50px;
            line-height: 1.6;
            padding-left: 5%;
        }

        .content a {
            color: #0000EE;
            text-decoration: underline;
        }

        .footer {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
            border-top: 1px solid #dddddd;
        }
        .content a {
            color: black;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{url('/').'/img/turmeda-mail-logo.png'}}" alt="Turmeda Logo">
    </div>

    <div class="content">
        <p>Translator Bilgilendirme-Dosyalar Mevcuttur</p>
        <p>Dosyalar mevcuttur aşağıdaki sayfaya yönlendire tıklayarak sayfaya gidip indirebilirsiniz </p>
        <p><a href="{{$data['link']}}">Sayfaya Yönlendir</a></p>
    </div>

    <div class="footer">
        Adres: Beylikdüzü OSB 3th Street No:8 Corner Office, 44, Beylikdüzü Istanbul &nbsp;|&nbsp; Telefon: +90 212 875 54 42 -43
    </div>
</div>

</body>
</html>

