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
 * @param $texto
 */
function escribirVioleta($texto)
{
    echo "\e[0;35;40m$texto\e[0m";
}
/**
 * Recibe un string y lo escribe por consola en color azul.
 * @param $texto
 */
function escribirAzul($texto)
{
    echo "\e[1;34;40m$texto\e[0m";
}

/**
 * Muestra el logo del juego 
 * 
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
            ["palabraWordix" => "CASAS", "jugador" => "gabi", "intentos" => 4, "puntaje" => 3],
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
    escribirVioleta("Volviendo al menu principal en \n");
    for ($i = 5; $i > 0; $i--) {
        escribirAzul($i."s\r");
        sleep(1);
    }
    echo "\n";
    
}


/**
 * Muestra los datos de una partida específica. Recibe el arreglo de partidas, 
 * y pide al usuario el numero de partida a visualizar. En caso de existir la muestra, caso contrario muestra un mensaje de error.
 * @param $coleccionPartidas
 * @return void
 */
function mostrarPartida($listaPartidas){
    // int $numeroPartida, $intentos
   escribirAzul("Ingrese el número de partida que desea ver: ");    
   //Pasar por validacion de numero el dato ingresado.
   $numeroPartida = solicitarNumeroEntre(1,count($listaPartidas));
   //Resto uno al numero de partida para que coincida con el indice del arreglo
   $numeroPartida = $numeroPartida - 1;
   //Dejo mas prolijo el codigo 
    $intentos = $listaPartidas[$numeroPartida]["intentos"];
    echo str_repeat("\n",10);
    escribirAzul("************************************************************\n");
    escribirAzul("Partida WORDIX ".($numeroPartida+1).":");
    escribirVioleta("palabra ".$listaPartidas[$numeroPartida]["palabraWordix"]."\n");
    escribirAzul("Jugador: ");
    escribirVioleta($listaPartidas[$numeroPartida]["jugador"]."\n");
    escribirAzul("Puntaje: ");
    escribirVioleta($listaPartidas[$numeroPartida]["puntaje"]." puntos \n");
    escribirAzul("Intentos: ");
    escribirVioleta((( $intentos === 0 ) ? "No adivino la palabra\n" : "Adivino la palabra en " .$intentos." intent".(($intentos===1)?"o":"os"). "\n"));
    escribirAzul("************************************************************\n");

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
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 2:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 3:
            //Mostrar una partida
            mostrarPartida($coleccionPartidas);
            esperarUnosSegundosAntesDeContinuar();
            break;
        case 4:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 4
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
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 7
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
