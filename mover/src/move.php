<?php
$cloud = $_GET['cloud'];
$namespace = "techu-demo";
if(file_exists("/tmp/cloud.txt")) {
    $atual = chop(file_get_contents("/tmp/cloud.txt"));
} else {
    $atual = "s390x";
}
echo "Migrando de $atual para $cloud";
if($cloud == "aws") {
    $endereco_api_destino = getenv("ENDERECO_API_AWS");
    $token_api_destino = getenv("TOKEN_API_AWS");
}
if($cloud == "s390x") {
    $endereco_api_destino = getenv("ENDERECO_API_S390");
    $token_api_destino = getenv("TOKEN_API_S390");
}
if($cloud == "gcloud") {
    $endereco_api_destino = getenv("ENDERECO_API_GCLOUD");
    $token_api_destino = getenv("TOKEN_API_GCLOUD");
}
if($atual == "aws") {
    $endereco_api_origem = getenv("ENDERECO_API_AWS");
    $token_api_origem = getenv("TOKEN_API_AWS");
}
if($atual == "s390x") {
    $endereco_api_origem = getenv("ENDERECO_API_S390");
    $token_api_origem = getenv("TOKEN_API_S390");
}
if($atual == "gcloud") {
    $endereco_api_origem = getenv("ENDERECO_API_GCLOUD");
    $token_api_origem = getenv("TOKEN_API_GCLOUD");
}
$comando =  "echo $cloud > /tmp/cloud.txt";
exec($comando);
$comando = "ansible-playbook /playbooks/deploy_app_oc.yaml -e \"ENDERECO_API_DESTINO=$endereco_api_destino TOKEN_API_DESTINO=$token_api_destino ENDERECO_API_ORIGEM=$endereco_api_origem TOKEN_API_ORIGEM=$token_api_origem CLOUD=$cloud NAMESPACE=$namespace\" ";
echo $comando;
exec($comando, $Matriz);
print_r($Matriz);
?>