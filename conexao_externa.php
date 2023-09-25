<?php
// require_once 'vendor/phpqrcode-master/qrlib.php';

// O link que será encurtado
$url = 'https://www.google.com';

// Encurte o link usando um serviço como o bit.ly ou o TinyURL

// Gere o QR Code com o link encurtado
//  QRcode::svg($url);
// Define as credenciais de conexão
// phpinfo();
$servername = "10.111.111.111"; //nome_do_servidor_dns
$username = "root";
$password = "";
$dbname = "";

// Define as configurações do proxy
$proxy_host = "10.111.111.111"; // nome_do_host_do_proxy
$proxy_port = "1118"; // porta_do_proxy

// Define as configurações do túnel SSH (se necessário)
$ssh_host = "10.111.111.111"; // nome_do_servidor_ssh
$ssh_user = ""; // nome_do_usuario_ssh
$ssh_pass = ""; // senha_do_usuario_ssh

/// Cria um novo contexto de stream
$opts = array(
  'http' => array(
      'proxy' => 'tcp://' . $proxy_host . ':' . $proxy_port,
      'request_fulluri' => true,
      'header' => "Proxy-Authorization: Basic " . base64_encode("$username:$password") . "\r\n",
  ),
  'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
  )
);
$context = stream_context_create($opts);

// Cria uma conexão usando a função mysqli_connect()
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if (!$conn) {
  die("Conexão falhou: " . mysqli_connect_error());
}else{
  echo 'conexão feita <br>';
}

// Executa uma consulta SQL
$sql = "SELECT * FROM acabamentos";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Exibe os resultados em um loop
  while($row = mysqli_fetch_assoc($result)) {
      echo "ID: " . $row["CODIGO"] . " - Nome: " . $row["MAQUINA"] . "<br>";
  }
} else {
  echo "Nenhum resultado encontrado";
}
// Inclua a biblioteca QR Code
