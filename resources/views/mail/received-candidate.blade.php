<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: #f4f4f4;">

    <div id="container" style="margin: 0 auto; width:600px; background-color:white;">
        <div style="background-color:red; padding:10px; text-align:center;">
               <img src="{{ asset('assets/img/logo-dkt.png') }}">
        </div>
        <div style="padding: 20px">

               <h1>Ha recibido una nueva vacante para: {{ $data->job->title }}</h1>

        <p>Nombre del candidato: {{ $data->name }}</p>
        <p>Email del candidato: {{ $data->email }}</p>
        <p>Telefono del candidato: {{ $data->phone }}</p>
        </div>
     

      
    </div>
    
</body>
</html>