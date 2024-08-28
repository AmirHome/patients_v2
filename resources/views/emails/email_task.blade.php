<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Bildirimi</title>
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
            border: 1px solid #dddddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #009ddc;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .header img {
            width: auto;
        }

        .content {
            padding: 30px;
            line-height: 1.6;
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
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ asset('img/template-logo.png') }}" alt="Şirket Logo">
    </div>

    <div class="content">
        <p>Merhaba,</p>
        <p>{{$data['user']}} tarafından size yeni bir görev tanımlandı. Görevin başlığı "<strong>{{$data['title']}}</strong>" olup, görev ID'si <strong>{{$data['task_id']}}</strong> olarak belirlenmiştir. Görevin durumu şu an için <strong>{{$data['status']}}</strong> olarak belirtilmiştir.
            {{-- {{$data['user_id']}} şuan için gerekli değil --}}
        <p>Görev detaylarını incelemek ve gerekli aksiyonları almak için lütfen <a href="{{url('admin')/tasks/{{$data['task_id']}}">buraya tıklayın</a>.</p>
        <p>İyi çalışmalar dileriz.</p>
    </div>

    <div class="footer">
        Adres: Beylikdüzü OSB 3th Street No:8 Corner Office, 44, Beylikdüzü Istanbul &nbsp;|&nbsp; Telefon: +90 212 875 54 42 -43
    </div>
</div>

</body>
</html>
