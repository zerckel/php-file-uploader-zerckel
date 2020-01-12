<?php
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);
define('MB', 1048576);

if (!empty($_POST)){
    try {
        $uploader = new fileStorage($_POST['name'], $_FILES);
        $name = $uploader->getName();
        $path = $uploader->getPath();
        $message = $uploader->upload();
    }catch (Exception $e){
        $message = 'veuillez remplir tout les champs';
    }
}

if(isset($message) AND $message !== false){
    echo $twig->render('index.html', ['message' => $message]);
}else if (!empty($_POST)){
    echo $twig->render('index.html', ['path' => $path, 'name'=>$name]);
}else{
    echo $twig->render('index.html');
}
