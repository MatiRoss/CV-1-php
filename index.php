<?php
$metaTitle = "CV de Mati Ross";
$metaDescription = "Bienvenue sur mon CV en ligne";
include 'header.php';
if (isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    if ($page == 'hobby') {
        require(__DIR__ . '/pages/hobby.php');
    } else if ($page == 'contact') {
        require(__DIR__ . '/pages/contact.php');
    } else {
        require(__DIR__ . '/pages/404.php');
    }

} else {
    require 'pages/cv.php';
}

include 'footer.php';
