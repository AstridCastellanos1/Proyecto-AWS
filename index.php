<?php

require_once 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

if( isset($_FILES['file')){
    s3_upload_put_object($_FILES['file']);
}

function s3_upload_put_object($file){
    $options = [
        'region' => 'us-east-1',
        'version' => 'latest',
        'credentials' => [
            'key' => 'tu clave',
            'secret' => 'tu clave secreta',
        ]
    ];
    date_default_timezone_set('America/Guatemala');
    $DateAndTime = date('d', time());

    $file_name = $file['name'];
    $file_path = $file['tmp_name'];
    try{
        $s3Client = new S3Client($options);
        $result = $s3Client->putObject([
            'Bucket' => 'umg-documentos2',
            'Key' => 'Progra3/2022/04/'.$DateAndTime.'/tu carnet/'.$file_name,
            'SourceFile' => $file_path,
        ]);
        echo "<pre>".print_r($result, true)."</pre>";
    }catch(S3Exception $e){
        echo $e->getMessage() . "\n";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
    content="IE=edge">
    <meta name="viewport"
    content="width=divice-width, initial-scale=1.0">
    <title>Proyecto AWS</title>
</head>
<body>
    <form action="" method="post"
    enctype="multipart/form-data">
    <label for="file">Subir Archivo</label>
    <input type="file" name="file" id="file">
    <button type="submit">Enviar Archivo</button>
</body>
</html>