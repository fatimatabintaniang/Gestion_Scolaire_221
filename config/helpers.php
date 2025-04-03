<?php
function RenderView(string $views,array $data=[], string $layout) {
    ob_start();
    extract($data);
    require_once "../views/$views.html.php";
    $content=ob_get_clean();
    require_once "../views/layout/$layout.php";
}

// function isConnect(){
//     $_SESSION[$key]=$value;
// }

// function addToSession(){
//     return isset($_SESSION['user']);
// }
?>