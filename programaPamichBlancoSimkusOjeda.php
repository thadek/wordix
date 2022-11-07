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
{
    //Inicializo el arreglo
    $coleccionPartidasPreCargadas = [];
    // Precarga de partidas
    $coleccionPartidasPreCargadas =
        [
            ["palabraWordix" => "MUJER", "jugador" => "gabi", "intentos" => 3, "puntaje" => 4],
            ["palabraWordix" => "QUESO", "jugador" => "ale", "intentos" => 2, "puntaje" => 5],
            ["palabraWordix" => "MELON", "jugador" => "julian", "intentos" => 6, "puntaje" => 1],
            ["palabraWordix" => "FUEGO", "jugador" => "julians", "intentos" => 5, "puntaje" => 2],
            ["palabraWordix" => "QUESO", "jugador" => "gabi", "intentos" => 4, "puntaje" => 3],
            ["palabraWordix" => "TARTA", "jugador" => "jose", "intentos" => 3, "puntaje" => 4],
            ["palabraWordix" => "TORTA", "jugador" => "majo", "intentos" => 1, "puntaje" => 6],
            ["palabraWordix" => "ARBOL", "jugador" => "ale", "intentos" => 2, "puntaje" => 5],
            ["palabraWordix" => "SALAS", "jugador" => "maria", "intentos" => 3, "puntaje" => 4],
            ["palabraWordix" => "RASGO", "jugador" => "majo", "intentos" => 6, "puntaje" => 1]
        ];
    return ($coleccionPartidasPreCargadas);
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
    /** string $palabraNueva */

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
    /** boolean $yaJugo */
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
 * Esta funcion lee el nombre de un jugador, verifica que sea una palabra y en caso de serlo, lo retorna.
 * @return string
 */
function leerNombreJugador()
{
    /** string $nombreJugador */
    escribirAzul("Ingrese su nombre: ");
    $nombreJugador = trim(fgets(STDIN));
    while (!esPalabra($nombreJugador)) {
        escribirAzul("❌❌ El nombre ingresado no es válido, ingrese un nombre válido ❌❌ \n");
        escribirAzul("Ingrese su nombre: ");
        $nombreJugador = trim(fgets(STDIN));
    }
    return $nombreJugador;
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
    if ($palabraAleatoriaSinJugar !== "JUGO_TODAS") {
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
    while ($i < $n && $nombreGanador != $nombre && $listaDePartidas[$i]["puntaje"] > 0) {
        $nombre = $listaDePartidas[$i]["jugador"];
        $i = $i + 1;
    }
    // En caso de que el nombre solicitado coincida con alguno de los del arreglo se mostrara su primera partida ganada
    if ($nombreGanador == $nombre) {
        $nombreGanador = $nombre;
        $i = $i - 1;
        //Agrego el numero de partida como clave a la partida solicitada para mostrarla
        $listaDePartidas[$i]["numeroPartida"] = $i + 1;
        mostrarPartida($listaDePartidas[$i]);
    }
    // En este caso seria de que el nombre de jugador todavia no haya jugado o ganado una partida de WORDIX
    else {
        echo str_repeat("\n", 5);
        escribirAzul("El jugador ");
        escribirVioleta($nombreGanador);
        escribirAzul(" todavia no ha jugado o ganado una partida de WORDIX\n");
    }
}

/* ... COMPLETAR ... */



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
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 5
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 6:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 6
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 7:
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

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
