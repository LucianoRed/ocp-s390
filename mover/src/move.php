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
$token_cloudflare = getenv("TOKEN_CLOUDFLARE");
$api_cloudflare = getenv("API_CLOUDFLARE");
$email_cloudflare = getenv("EMAIL_CLOUDFLARE");
$comando =  "echo $cloud > /tmp/cloud.txt";
exec($comando);
$comando = "ansible-playbook /playbooks/deploy_app_oc.yaml -e \"ENDERECO_API_DESTINO=$endereco_api_destino TOKEN_API_DESTINO=$token_api_destino ENDERECO_API_ORIGEM=$endereco_api_origem TOKEN_API_ORIGEM=$token_api_origem CLOUD=$cloud TOKEN_CLOUDFLARE=$token_cloudflare API_CLOUDFLARE=$api_cloudflare EMAIL_CLOUDFLARE=$email_cloudflare NAMESPACE=$namespace\" ";
echo $comando;
exec($comando, $Matriz);
print_r($Matriz);
?>