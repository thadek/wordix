<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* Pamich Gabriel, FAI-1515, TUDW, gabriel.pamich@est.fi.uncoma.edu.ar, GitHub: /thadek
*  Blanco Julian, FAI-3858, TUDW, julian.blanco@est.fi.uncoma.edu.ar , GitHub: /juliaanbl
*  Simkus Julian, FAI-4237, TUDW, simkusj@yahoo.com.ar, GitHub: /SimkusJ
*  Ojeda Alejandra FAI-4231,TUDW, malejandra.ojeda@est.fi.uncoma.edu.ar,GitHub: /alejandraob
*/



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "AGUAS", "SAPOS", "SALTO", "TARTA", "HORAS",
        "COCHE", "AUTOS", "ARBOL", "SALAS", "TORTA"
    ];

    return ($coleccionPalabras);
}

/**
 * Recibe un string y lo escribe por consola en color violeta.
 * @param string $texto
 */
function escribirVioleta($texto)
{
    echo "\e[0;35;40m$texto\e[0m";
}
/**
 * Recibe un string y lo escribe por consola en color azul.
 * @param string $texto
 */
function escribirAzul($texto)
{
    echo "\e[1;34;40m$texto\e[0m";
}

/**
 * Muestra el logo del juego 
 */
function escribirLogo()
{
    escribirAzul("
 ██╗    ██╗ ██████╗ ██████╗ ██████╗ ██╗██╗  ██╗
 ██║    ██║██╔═══██╗██╔══██╗██╔══██╗██║╚██╗██╔╝
 ██║ █╗ ██║██║   ██║██████╔╝██║  ██║██║ ╚███╔╝ 
 ██║███╗██║██║   ██║██╔══██╗██║  ██║██║ ██╔██╗ 
 ╚███╔███╔╝╚██████╔╝██║  ██║██████╔╝██║██╔╝ ██╗
  ╚══╝╚══╝  ╚═════╝ ╚═╝  ╚═╝╚═════╝ ╚═╝╚═╝  ╚═\n");
    escribirVioleta("*********************************************************\n");
    echo "\n";
}


/**
 * Carga 10 partidas de ejemplo en un arreglo y lo devuelve
 * @return array
 */
function cargarPartidas()
{   // Precarga de partidas
    // array $coleccionPartidasPreCargadas
    $coleccionPartidasPreCargadas =
        [
            ["palabraWordix" => "MUJER", "jugador" => "gabi", "intentos" => 3, "puntaje" => 4],
            ["palabraWordix" => "QUESO", "jugador" => "ale", "intentos" => 2, "puntaje" => 5],
            ["palabraWordix" => "MELON", "jugador" => "julian", "intentos" => 6, "puntaje" => 1],
            ["palabraWordix" => "FUEGO", "jugador" => "julians", "intentos" => 5, "puntaje" => 2],
            ["palabraWordix" => "QUESO", "jugador" => "gabi", "intentos" => 4, "puntaje" => 3],
            ["palabraWordix" => "TARTA", "jugador" => "jose", "intentos" => 3, "puntaje" => 4],
            ["palabraWordix" => "TORTA", "jugador" => "majo", "intentos" => 0, "puntaje" => 0],
            ["palabraWordix" => "ARBOL", "jugador" => "ale", "intentos" => 2, "puntaje" => 5],
            ["palabraWordix" => "SALAS", "jugador" => "maria", "intentos" => 3, "puntaje" => 4],
            ["palabraWordix" => "RASGO", "jugador" => "majo", "intentos" => 0, "puntaje" => 0],
            ["palabraWordix" => "RASGO", "jugador" => "majo", "intentos" => 1, "puntaje" => 6]

        ];
    return $coleccionPartidasPreCargadas;
}

/**
 * Muestra el menu de opciones
 */
function escribirMenu()
{
    escribirAzul("👾¡Bienvenido! ¿Qué desea hacer?👾\n");
    escribirVioleta("1) Jugar al Wordix con una palabra elegida\n2) Jugar al Wordix con una palabra aleatoria\n3) Mostrar una partida\n4) Mostrar la primer partida ganadora\n5) Mostrar resumen de Jugador\n6) Mostrar listado de partidas ordenadas por jugador y por palabra\n7) Agregar una palabra de 5 letras a Wordix\n8) Salir\n");
    escribirAzul("Ingrese una opción: ");
}

/**
 * Esta funcion es para que no te muestre el menu principal instantaneamente al terminar otro proceso.
 */
function esperarUnosSegundosAntesDeContinuar()
{
    escribirVioleta("\nVolviendo al menu principal en \n");
    for ($i = 5; $i > 0; $i--) {
        escribirAzul($i . "s\r");
        sleep(1);
    }
    echo "\n\n";
}

/** Agrega una palabra nueva al arreglo que viene por parametro reutilizando una funcion
 * que valida la palabra ingresada por el usuario
 * @param array $arregloPalabras
 * @return array 
 */
function agregarPalabra($arregloPalabras)
{
    //string $palabraNueva 
    escribirAzul("Agregar palabra nueva a WORDIX o escriba salir para volver al menu anterior \n");
    $palabraNueva = leerPalabra5Letras();
    // Mientras la palabra exista dentro del arreglo solicitara una palabra nueva

    while (($palabraNueva != "SALIR") && (in_array($palabraNueva, $arregloPalabras))) {
        escribirAzul("❌❌ La palabra " . $palabraNueva . " ingresada ya existe, ingrese otra o escriba salir para volver al menu anterior ❌❌ \n");
        $palabraNueva = leerPalabra5Letras();
    }

    if ($palabraNueva != "SALIR") {
        //agrego la palabra nueva al arreglo existente
        array_push($arregloPalabras, $palabraNueva);
        escribirVioleta("Se agrego la palabra: " . $palabraNueva . "\n");
    }
    return $arregloPalabras;
}

/**
 * Esta funcion verifica si el usuario jugo esa palabra anteriormente y retorna true o false segun el caso.
 * @param array $arregloPalabras
 * @param string $palabra
 * @param string $nombreJugador
 * @return boolean
 */
function verificarSiElUsuarioYaJugoEsaPalabra($arregloPartidas, $palabra, $nombreJugador)
{
    // boolean $yaJugo 
    // int $totPartidas, $i
    $yaJugo = false;
    $totPartidas = count($arregloPartidas);
    $i = 0;

    //Recorro parcialmente el arreglo de partidas hasta encontrar la palabra que el usuario ingreso
    while ((!$yaJugo) && ($i < $totPartidas)) {
        if (($arregloPartidas[$i]["palabraWordix"] == $palabra) && ($arregloPartidas[$i]["jugador"] == $nombreJugador)) {
            $yaJugo = true;
        }
        $i++;
    }

    return $yaJugo;
}

/**
 * Esta funcion lee el nombre de un jugador, 
 * verifica sea una Palabra, 
 * que tenga entre 3 y 10 caracteres, 
 * que no este vacio y 
 * retorna el nombre en minusculas.
 * @return string
 */
function leerNombreJugador()
{
    // string $nombreJugador 
    escribirAzul("Ingrese su nombre: ");
    $nombreJugador = trim(fgets(STDIN));
    while (!esPalabra($nombreJugador) || $nombreJugador == "" || ((strlen($nombreJugador) < 3) || (strlen($nombreJugador) > 10))) {
        escribirAzul("❌❌ El nombre ingresado no es válido, ingrese un nombre válido ❌❌ \n");
        escribirAzul("Ingrese su nombre: ");
        $nombreJugador = trim(fgets(STDIN));
    }

    return strtolower($nombreJugador);
}

/**
 * Obtengo las partidas jugadas por un jugador y las retorno en un arreglo
 * @param array $arregloPartidas
 * @param string $nombreJugador
 * @return array
 */
function obtenerPartidasDeUnJugador($arregloPartidas, $nombreJugador)
{
    // array $partidasDeUnJugador
    $partidasDeUnJugador = [];
   
    //Armo un arreglo asociativo con las partidas de ese jugador.
    $partidasDeUnJugador = array_filter($arregloPartidas, function ($partida) use ($nombreJugador) {
        /*Esta funcion recibe un array asociativo que contiene los datos 
        de una partida del arregloPartidas y retorna true si la key jugador es igual a $nombreJugador que viene de la funcion principal 
        (El use $nombrejugador es para que se incluya en el contexto 
        la variable que viene de la funcion principal)*/
        return ($partida["jugador"] === $nombreJugador);
    });

    return $partidasDeUnJugador;
}




/**
 * Esta funcion recibe un arreglo de palabras, un arreglo de partidas y el nombre de un jugador. Filtra
 * las palabras que jugo ese jugador del arreglo principal de palabras y retorna una palabra al azar 
 * que ese jugador NO haya jugado. En caso de haber jugado todas las palabras del arreglo principal, 
 * retorna el string "JUGO_TODAS".
 * @param array $arregloPalabras
 * @param array $arregloPartidas
 * @param string $nombreJugador
 * @return string
 */
function obtenerPalabraAleatoriaSinJugar($arregloPalabras, $arregloPartidas, $nombreJugador)
{
    // string $palabraAleatoriaSinJugar
    // array $arregloPartidasJugador, $arregloPalabrasJugador, $arregloPalabrasSinJugar
    $palabraAleatoriaSinJugar = "";
    // A partir del del arreglo de partidas de un jugador creo un arreglo indexado de palabras jugadas
    $arregloPalabrasJugador = array_column(obtenerPartidasDeUnJugador($arregloPartidas, $nombreJugador), "palabraWordix");

    if (count($arregloPalabrasJugador) === 0) {
        //Si no jugo ninguna palabra, retorno una palabra aleatoria
        $palabraAleatoriaSinJugar = $arregloPalabras[array_rand($arregloPalabras)];
    } else {
        //Si jugo alguna palabra, retorno una palabra aleatoria que no haya jugado.
        /*Creo un arreglo con las palabras que no jugo ese jugador usando array_diff, 
        que funciona como una diferencia de conjuntos. */
        $arregloPalabrasSinJugar = array_diff($arregloPalabras, $arregloPalabrasJugador);
        /* CONTEMPLO CASO ESPECIAL : Si el arreglo de palabras sin jugar esta vacio, 
        significa que el jugador ya jugo todas las palabras */
        if (count($arregloPalabrasSinJugar) === 0) {
            escribirVioleta("🙌Ya jugaste todas las palabras, ¡Felicitaciones!😊 \n");
            $palabraAleatoriaSinJugar = "JUGO_TODAS";
        } else {
            // Asigno una palabra aleatoria del arreglo de palabras sin jugar.
            $palabraAleatoriaSinJugar = $arregloPalabrasSinJugar[array_rand($arregloPalabrasSinJugar)];
        }
    }

    return $palabraAleatoriaSinJugar;
}




/**
 * Esta función inicia una partida de wordix con una palabra elegida por el usuario, 
 * comprueba que este no la haya jugado anteriormente 
 * y retorna la coleccion de partidas la ultima partida jugada.
 * @param array $arregloPalabras Array indexado con las palabas de 5 letras.
 * @param array $arregloPartidas Array indexado que contiene arrays asociativos con las partidas jugadas.
 * @return array
 */
function jugarEligiendoPalabra($arregloPalabras, $arregloPartidas)
{
    // string $nombreJugador
    // int numeroPalabra
    // array $partida

    //Solicito el nombre del jugador validando una entrada correcta.
    $nombreJugador = leerNombreJugador();
    //Solicito el numero de palabra a jugar, validando que sea un numero y que este dentro del rango del arreglo.
    escribirAzul("\nIngrese el numero de la palabra a jugar: ");
    $numeroPalabra = solicitarNumeroEntre(1, count($arregloPalabras));
    //Ajusto el numero de palabra para que coincida con el indice del arreglo
    $numeroPalabra--;
    //Verifico que el numero de palabra no haya sido jugado anteriormente por ese jugador
    if (verificarSiElUsuarioYaJugoEsaPalabra($arregloPartidas, $arregloPalabras[$numeroPalabra], $nombreJugador)) {
        escribirAzul("\n❌❌ " . $nombreJugador . ", ya jugaste esa palabra. Volvé a intentar con otro numero de palabra ❌❌ \n");
    } else {
        //Juego la palabra elegida
        $partida = jugarWordix($arregloPalabras[$numeroPalabra], $nombreJugador);
        //Agrego la partida al arreglo de partidas
        array_push($arregloPartidas, $partida);
    }
    return $arregloPartidas;
}





/**
 * Esta función inicia una partida de wordix con una palabra elegida aleatoriamente,
 * comprobando que el jugador ingresado no la haya jugado anteriormente y 
 * retorna la coleccion de partidas modificada o no segun el caso.
 * @param array $arregloPalabras Array indexado con las palabas de 5 letras.
 * @param array $arregloPartidas Array indexado que contiene arrays asociativos con las partidas jugadas.
 * @return array
 */
function jugarConPalabraAleatoria($arregloPalabras, $arregloPartidas)
{
    // string $nombreJugador
    // int numeroPalabra
    // array $partida

    //Solicito el nombre del jugador validando una entrada correcta.
    $nombreJugador = leerNombreJugador();
    //Obtengo una palabra aleatoria que no haya jugado el jugador
    $palabraAleatoriaSinJugar = obtenerPalabraAleatoriaSinJugar($arregloPalabras, $arregloPartidas, $nombreJugador);
    //Juego la palabra aleatoria si no jugo todas las palabras
    if ($palabraAleatoriaSinJugar != "JUGO_TODAS") {
        $partida = jugarWordix($palabraAleatoriaSinJugar, $nombreJugador);
        //Agrego la partida al arreglo de partidas
        array_push($arregloPartidas, $partida);
    }
    //Devuelvo el arreglo de partidas modificado o no segun el caso.
    return $arregloPartidas;
}



/**
 * Muestra por pantalla los resultados de una partida recibida por parámetro.
 * @param array $partida
 */
function mostrarPartida($partida)
{
    echo str_repeat("\n", 3);
    escribirAzul("************************************************************\n");
    escribirAzul("Partida WORDIX " . $partida["numeroPartida"] . ":");
    escribirVioleta("palabra " . $partida["palabraWordix"] . "\n");
    escribirAzul("Jugador: ");
    escribirVioleta($partida["jugador"] . "\n");
    escribirAzul("Puntaje: ");
    escribirVioleta($partida["puntaje"] . " puntos \n");
    escribirAzul("Intentos: ");
    escribirVioleta(((($partida["intentos"]) === 0) ? "No adivino la palabra\n" : "Adivino la palabra en " . ($partida["intentos"]) . " intent" . ((($partida["intentos"]) === 1) ? "o" : "os") . "\n"));
    escribirAzul("************************************************************\n");
    echo str_repeat("\n", 3);
}




/**
 * Muestra los datos de una partida específica. Recibe el arreglo de partidas, 
 * y pide al usuario el numero de partida a visualizar. En caso de existir la muestra, caso contrario muestra un mensaje de error.
 * @param array $listaPartidas
 * @return void
 */
function mostrarPartidaEspecifica($listaPartidas)
{
    // int $numeroPartida
    escribirAzul("Ingrese el número de partida que desea ver: ");
    //Pasar por validacion de numero el dato ingresado.
    $numeroPartida = solicitarNumeroEntre(1, count($listaPartidas));
    //Resto uno al numero de partida para que coincida con el indice del arreglo
    $numeroPartida = $numeroPartida - 1;
    //Agrego el numero de partida como clave a la partida solicitada para mostrarla
    $listaPartidas[$numeroPartida]["numeroPartida"] = $numeroPartida + 1;
    //Muestro la partida
    mostrarPartida($listaPartidas[$numeroPartida]);
}

/**
 * Muestra la primera partida ganadora del jugador que se ingresa por teclado.
 * @param array $listaDePartidas
 * @return void
 */
function mostrarPrimeraPartidaGanadora($listaDePartidas)
{
    // int $n, $i
    // string $nombre $nombreGanador
    // Asigno la cantidas de partidas a $n
    $n = count($listaDePartidas);
    // Inicializo $i
    $i = 0;
    // Inicializo $nombre
    $nombre = "";
    // Solicito el nombre del jugador el cual quiero ver su primera partida ganada
    $nombreGanador = leerNombreJugador();
    // Realizo un recorrido parcial que se cortara al encontrar el elemento
    while (($i < $n) && ($nombreGanador != $nombre)) {

        if ($listaDePartidas[$i]["puntaje"] > 0) {
            $nombre = $listaDePartidas[$i]["jugador"];
        }
        $i = $i + 1;
    }
    // En caso de que el nombre solicitado coincida con alguno de los del arreglo se mostrara su primera partida ganada
    if ($nombreGanador == $nombre) {
        $i = $i - 1;
        //Agrego el numero de partida como clave a la partida solicitada para mostrarla
        $listaDePartidas[$i]["numeroPartida"] = $i + 1;
        mostrarPartida($listaDePartidas[$i]);
    }
    // En este caso seria de que el nombre de jugador todavia no haya jugado o ganado una partida de WORDIX
    else {
        echo str_repeat("\n", 3);
        escribirAzul("El jugador ");
        escribirVioleta($nombreGanador);
        escribirAzul(" todavia no ha jugado o ganado una partida de WORDIX\n");
    }
}


/** 
 * Esta funcion tendra que leer el nombre del jugador y un resumen de juego del participante
 * @param array $arregloPartidas
 */
function estadisticaJugador($arregloPartidas)
{ 
    //String $nombreJugador
    // array $arregloEstadistica
    $nombreJugador = leerNombreJugador();
    $arregloEstadistica = obtenerEstadisticasJugador($arregloPartidas, $nombreJugador);
    mostrarEstadisticasPlayer($arregloEstadistica);
}

/**
 * Muestra por pantalla los resultados de una partida recibida por parámetro.
 * @param array $estadisticas
 */
function mostrarEstadisticasPlayer($estadisticas)
{
    echo str_repeat("\n", 3);
    escribirAzul("************************************************************\n");
    if($estadisticas["totalPartidas"] == 0){
        escribirAzul("🎈El jugador ");
        escribirVioleta($estadisticas["jugador"]);
        escribirAzul(" no ha jugado ninguna partida de WORDIX.🎈\n");
    }else{
        escribirVioleta("Jugador: " . $estadisticas["jugador"] . "\n" .
        "Partidas: " . $estadisticas["totalPartidas"] . "\n" .
        "Puntaje Total: " . $estadisticas["puntajeTotal"] . "\n" .
        "Victorias: " . $estadisticas["victorias"] . "\n" .
        "Porcentaje Victorias: " . $estadisticas["porcentaje"] . "% \n " .
        "Adivinadas: \n" .
        "   Intento 1: " . $estadisticas["intento1"] . "\n" .
        "   Intento 2: " . $estadisticas["intento2"] . "\n" .
        "   Intento 3: " . $estadisticas["intento3"] . "\n" .
        "   Intento 4: " . $estadisticas["intento4"] . "\n" .
        "   Intento 5: " . $estadisticas["intento5"] . "\n" .
        "   Intento 6: " . $estadisticas["intento6"] . "\n");
    }
    //escribirVioleta(. "\n"));
    escribirAzul("************************************************************\n");
    echo str_repeat("\n", 3);
}




/**
 * Esta funcion  recibe el nombre de un jugador y genera un arreglo asociativo con las estadistica del mismo y lo retorna
 * @param array $arregloPartidas
 * @param string $nombreJugador
 * @return array $estadisticasPlayer
 */
function obtenerEstadisticasJugador($arregloPartidas, $nombreJugador)
{

    // array $estadisticasPlayer, $arregloPartidasJugador
    //Creamos array asociativo para guardar la informacion del jugador
    $estadisticasPlayer = [];
    $estadisticasPlayer = [
        "jugador" => $nombreJugador, "puntajeTotal" => 0, "victorias" => 0, "totalPartidas" => 0, "porcentaje" => 0,
        "intento1" => 0, "intento2" => 0, "intento3" => 0, "intento4" => 0, "intento5" => 0, "intento6" => 0
    ];


    $tiempo_inicial = microtime(true);
    //Ejecutamos funcion para saber el historial del jugar
    $arregloPartidasJugador = obtenerPartidasDeUnJugador($arregloPartidas, $nombreJugador);


    //Guardamos informacion del total de partidas
    $estadisticasPlayer["totalPartidas"] = count($arregloPartidasJugador);

    if ($estadisticasPlayer["totalPartidas"] > 0) {
        foreach ($arregloPartidasJugador as $partida) {
            //Sumamos los puntajes que tiene en cada juego
            $estadisticasPlayer["puntajeTotal"] += $partida["puntaje"];

            //Comprobamos que el puntaje sea superior a cero para saber que es una victoria
            if ($partida['puntaje'] > 0) {
                $estadisticasPlayer["victorias"]++;
            }
            //Contamos la cantidad de intentos realizados por cada partida
            switch ($partida['intentos']) {
                case 1:
                    $estadisticasPlayer['intento1']++;
                    break;
                case 2:
                    $estadisticasPlayer['intento2']++;
                    break;
                case 3:
                    $estadisticasPlayer['intento3']++;
                    break;
                case 4:
                    $estadisticasPlayer['intento4']++;
                    break;
                case 5:
                    $estadisticasPlayer['intento5']++;
                    break;
                case 6:
                    $estadisticasPlayer['intento6']++;
                    break;
                default:
                    break;
            }
        }
        //Calculamos el porcentaje de Victorias
        $estadisticasPlayer['porcentaje'] = round((($estadisticasPlayer['victorias'] / $estadisticasPlayer['totalPartidas']) * 100), 0);
    }

    $tiempo_final = microtime(true);
    $tiempo = $tiempo_final - $tiempo_inicial;
    escribirAzul("Tiempo de ejecucion de la funcion obtenerEstadisticasJugador + forEach arregloPartidasJugador: " .$tiempo . " segundos\n");

    $tiempo_inicial1 = microtime(true);
    if ($estadisticasPlayer["totalPartidas"] > 0) {
        foreach($arregloPartidas as $partida){

        //Calculo tiempo ejecucion 
        
        if($partida["jugador"] == $nombreJugador){

            $estadisticasPlayer["puntajeTotal"] += $partida["puntaje"];

            //Comprobamos que el puntaje sea superior a cero para saber que es una victoria
            if ($partida['puntaje'] > 0) {
                $estadisticasPlayer["victorias"]++;
            }
            //Contamos la cantidad de intentos realizados por cada partida
            switch ($partida['intentos']) {
                case 1:
                    $estadisticasPlayer['intento1']++;
                    break;
                case 2:
                    $estadisticasPlayer['intento2']++;
                    break;
                case 3:
                    $estadisticasPlayer['intento3']++;
                    break;
                case 4:
                    $estadisticasPlayer['intento4']++;
                    break;
                case 5:
                    $estadisticasPlayer['intento5']++;
                    break;
                case 6:
                    $estadisticasPlayer['intento6']++;
                    break;
                default:
                    break;
            }
        }
    }
    }
    
    $tiempo_final1 = microtime(true);
    $tiempo1 = $tiempo_final1 - $tiempo_inicial1;
    escribirAzul("Tiempo de ejecucion FOREACH: " . $tiempo1 . " segundos");
    
    return $estadisticasPlayer;
    

}





/**
 * Esta funcion recibe el arreglo de partidas y las ordena usando uasort por jugador y por palabra 
 * y lo muestra por pantalla con print_r 
 * @param array $arregloPartidas
 * 
 */
function ordenarYMostrarPartidasPorJugadoryPorPalabra($arregloPartidas)
{
    //Ordenamos el arreglo de partidas por jugador y por palabra
    uasort($arregloPartidas, function ($a, $b) {
        //Si el jugador es el mismo, ordeno por palabra
        if ($a['jugador'] == $b['jugador']) {
            //Devuelve la comparación de las palabras: 1 si es mayor, -1 si es menor, 0 si son iguales 
            return $a['palabraWordix'] <=> $b['palabraWordix'];
        }
        //Si el jugador es diferente, ordeno por jugador
        return $a['jugador'] <=> $b['jugador'];
    });
    //Mostramos el arreglo ordenado
    print_r($arregloPartidas);
}








/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
// ARRAY $coleccionPalabras, $coleccionPartidas
// INTEGER $opcion



//Inicialización de variables:
$coleccionPalabras = [];
$coleccionPartidas = [];

//Cargo las palabras en el arreglo de palabras
$coleccionPalabras = cargarColeccionPalabras();
//Cargo el arreglo de partidas precargadas en el arreglo de partidas
$coleccionPartidas = cargarPartidas();

escribirLogo();
//Proceso:
do {
    //Muestro el menu de opciones
    escribirMenu();
    //Leo la opcion elegida
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 1:
            //Juego una palabra elegida
            $coleccionPartidas = jugarEligiendoPalabra($coleccionPalabras, $coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 2:
            //Juego con palabra aleatoria
            $coleccionPartidas = jugarConPalabraAleatoria($coleccionPalabras, $coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 3:
            //Mostrar una partida
            mostrarPartidaEspecifica($coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 4:
            //Muestra primera partida ganadora
            mostrarPrimeraPartidaGanadora($coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 5:
            //Ver estadisticas de un jugador
            estadisticaJugador($coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 6:
            //Ordenar listado de partidas por jugador y por palabra
            ordenarYMostrarPartidasPorJugadoryPorPalabra($coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 7:
            //Agrego una palabra al arreglo de palabras
            $coleccionPalabras = agregarPalabra($coleccionPalabras);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 8:
            escribirVioleta("\n 👋👋 Gracias por jugar, vuelva pronto. 👀👋  \n");
            break;

        default:
            echo " \n\n ❌ Opción incorrecta. Intente nuevamente. ❌\n \n";
            break;
    }
} while ($opcion != 8);

