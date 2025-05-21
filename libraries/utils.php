<?php


function render(string $path, array $variables = [])

{



extract($variables);

ob_start();

require_once "layouts/".$path."_html.php";

$pageContent = ob_get_clean();

require_once 'layouts/layout_html.php';
}
function redirect(string $url):void{
    header("Location:$url");
exit;
}

?>
