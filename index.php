<?php

error_reporting(0);

$icons_path = "https://www.imelcf.gob.pa/wp-content/plugins/location-weather/assets/images/icons/weather-icons/";

$city = $_POST['city'];

$URL = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=13a90374849f8d04b244930a0d6c3885&units=metric&lang=es";

// Obtener los datos de la API -----
$stringMeteo = file_get_contents($URL); // devuelve un string
//echo $stringMeteo;

// Convertir el string en un JSON ------
$jsonMeteo = json_decode($stringMeteo, true);

// Obtener el icono ----
$icon_name = $jsonMeteo['weather']['0']['icon'];

// Obtener la ciudad ---

$city = $jsonMeteo['name'];

// Obtener la descripcion ---

$description = $jsonMeteo['weather']['0']['description'];

// Obtener la temperatura ---

$temp = $jsonMeteo['main']['temp'];

// Obtener la temperatura min ---

$temp_min = $jsonMeteo['main']['temp_min'];

//obtener la tempera max-----

$temp_max = $jsonMeteo['main']['temp_max'];

// Obtener la humedad   ---

$humidity = $jsonMeteo['main']['humidity'];

// Obtener la feels like

$feels_like = $jsonMeteo['main']['feels_like'];








?>

<!-- HTML  -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Meteo</title>
    <style>
         .container {
            width: 400px;
            background-color: ;
        }
        .section2 {
            width: 300px;
            margin: 0 auto;
            background-color: #2F6690;
            
            align-content: center;
            border: 3px solid #2F6690;
        }
        header { 
            text-align: center;
        }

        .divTiempo {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            border: 3px solid #2F6690;
            background-color: #CAE5FF;
        }
        
        img {
            width: 70%;
            margin: 0 auto;


        }


        h1 { 
        font-size: 300%;
        margin-bottom: 0;
        }

        #temp_1 {
            font-size: 400%;
            margin-bottom: 0;
            
        }
        form {
            margin: 5px 5px 0 10px;
        }
        header {
            color: white;
        }
        #p_descripcion {
            font-size: 100%;
            margin-top: 0%;
        }
    </style>
</head>
<body>
<header class="container section2">TIEMPO ACTUAL</header>

     


    <main>
        <section class="container divTiempo">
            <div>
                <h1><?=strtoupper($city)?></h1>
                <p id="p_descripcion"><?=$description?></p>
            </div>

            <div>
                <p id="temp_1"><?=$temp?>- Cº</p>
            </div>

            <div>
            <?php if ( !$stringMeteo) : ?>
                 <p><?= $city ?> : nombre de ciudad incorrecto</p>
             <?php else :?>
                <img src='<?= $icons_path.$icon_name.".svg" ?>' alt="Icono del tiempo">
                <?php endif; ?>
            </div>
            <div>
                 <p><?=$temp_min?>- Cº</p>
                 <p><?=$temp_max?>- Cº</p>
                 <p><?=$humidity?>- %</p>
                 <p>sensacion termica <?=$feels_like?>- Cº</p>
            </div>
            
        </section>
        <section class="container section2">
        <form action="index.php" method="post" class="container">
            <label for="city">CIUDAD</label>
            <input type="text" name="city" id="city" value=""/>
            <div>
            <button type="submit">enviar</button>
            </div>
            <div>
            <button type="reset">borrar</button>
            </div>
        </form>  
</div>
</div>
            </form>
        </section>
    </main>

</body>
</html>