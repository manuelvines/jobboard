<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bolsa de empleo de DKT</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
      <div class="bg-red-600 ">
        <img src="{{asset('dkt-latam-norte.png')}}" class="w-20" alt="">
      </div>

      <!---HERO-->
      <div class="flex flex-col p-8 justify-cente w-12/12">
               <div class="flex gap-5">
                  <x-select
                  class="w-4/12 "
                  label="Jornada laboral"    
                  placeholder="País"
                  wire:model.defer="workdayId">
                          
                  <x-select.option label="" value="1" />)
                   
        
                  </x-select>
              
                  <x-select
                  class="w-4/12 "

                  label="Estado"    
                  placeholder="Selecciona una opción"
                  wire:model.defer="workdayId">
                          
                  <x-select.option label="" value="1" />)
                   

        
                  </x-select> 


                  <x-button 
                  class="w-2/12 "

                  info label="Buscar empleo" />


               </div>
      </div>
    


    </body>
</html>
