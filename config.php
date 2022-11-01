<?php

//ruta raiz del proyecto
define('ROOT', dirname(__FILE__));
//ROOT + carpeta imagenes
define('RUTAEMPRESAS', ROOT . '\uploads\empresas' . "\\");
define('RUTACURSOS', ROOT . '\uploads\cursos' . "\\");
define('RUTAVIDEOSMINIATURAS', ROOT . '\uploads\videos\miniaturas' . "\\");
define('RUTAVIDEOS', ROOT . '\uploads\videos' . "\\");

//Para servidor
/*define('ROOT', $_SERVER['DOCUMENT_ROOT']);
//ROOT + carpeta imagenes
define('RUTAEMPRESAS', ROOT . '/uploads/empresas/');
define('RUTACURSOS', ROOT . '/uploads/cursos/');
define('RUTAVIDEOSMINIATURAS', ROOT . '/uploads/videos/miniaturas/');
define('RUTAVIDEOS', ROOT . '/uploads/videos/');*/


define("PAIS", "Argentina");


function conectar(){
  //7muDZ5|QOiSWki|P
  //jairo
  //conteniluz
  $host = "localhost";
  $usuario = "root";
  $contrasenia = "";
  $base_de_datos = "pablo";
 /* $host = "localhost";
  $usuario = "id19696295_jairo";
  $contrasenia = "7muDZ5|QOiSWki|P";
  $base_de_datos = "id19696295_conteniluz";*/


  $conn = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
  

  if ($conn->connect_errno) {
    echo "Falló la conexión a MySQL". mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
    error_log("You messed up!", 3, "errors.log");
    die;
  }else{

  }
  return $conn;
}

function desconectar($conn){
  $conn->close();
}

/*function geoLocalizacion(){
  $access_key = '8d222a82f44245c1c9c053915d083469';
  //$ip = $_SERVER['REMOTE_ADDR'];
  //echo $ip;
  // Initialize CURL:
  $ch = curl_init('http://api.ipstack.com/check?access_key='.$access_key.'');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // Store the data:
  $json = curl_exec($ch);
  curl_close($ch);

  // Decode JSON response:
  $api_result = json_decode($json, true);

  // Output the "capital" object inside "location"
  //echo $api_result['location']['capital'];
 // var_dump($api_result['location']);
  isset($api_result['country_name']) ? $pais = $api_result['country_name'] : $pais = "Argentina";
  return $pais;
}*/
?>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
//let access_key = '8d222a82f44245c1c9c053915d083469';
let access_key = '6ac927af579cd91ad7507f5d9eb89e1d';


async function getIpClient() {
    try {
        const response = await axios.get('https://api.ipify.org?format=json');
        return response.data.ip;
    } catch (error) {
        console.error(error);
    }
}

//Obtengo geolocalizacion con ipstack
async function getGeoLocation() {
    try {
        const ip = await getIpClient();
        //console.log(ip);
        const response = await axios.get('http://api.ipstack.com/' + ip + '?access_key=' + access_key + '');
        return response.data;
    } catch (error) {
        console.error(error);
    }
}

//Guardo en localstorage pais si no existe
async function guardarPais() {
    try {
        if (localStorage.getItem('pais') === null) {
            const pais = await getGeoLocation();
            localStorage.setItem('pais', pais.country_name);
        }else{
            //muestro pais
            console.log(localStorage.getItem('pais'));
        }
    } catch (error) {
        console.error(error);
    }
}

guardarPais();

//You can call the function getCookie with the name of the cookie you want, then check to see if it is = null.

/*function getCookie(name) {
    let dc = document.cookie;
    let prefix = name + "=";
    let begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    } else {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
            end = dc.length;
        }
    }
    // because unescape has been deprecated, replaced with decodeURI
    //return unescape(dc.substring(begin + prefix.length, end));
    return decodeURI(dc.substring(begin + prefix.length, end));
}*/

//guardo localizacion en cookie pais con venciomiento 1 año en segundos
/*async function setCookiePais() {
    let myCookie = getCookie("pais");
    //si no existe la cookie pais la creo
    if (myCookie == null) {
        const geoLocation = await getGeoLocation();
        const pais = geoLocation.country_name;
        //const d = new Date();
        //d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
        //const expires = "expires=" + d.toUTCString();
       // document.cookie = "pais=" + pais + ";" + expires + ";path=/";
        //myCookie = getCookie("pais");  
        myCookie = pais; 
        //return myCookie;
        //console.log(myCookie);
        //creo cookie del lado servidor
        axios.post('crearCookie.php', { pais: myCookie })
            .then(function (response) {
                //console.log(response);
            })
            .catch(function (error) {
                //console.log(error);
            });
    }else{
      console.log("...");
      console.log(myCookie);
    }
    //document.cookie = "pais=" + pais + ";" + expires + ";path=/";
}
//console.log(document.cookie.indexOf('pais'));*/
//setCookiePais();
</script>