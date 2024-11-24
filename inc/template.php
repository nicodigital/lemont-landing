<?php
class Template{
  private $content;

  public function __construct( $path, $layout = [] ){

    if (!file_exists($path)) {
      // Redirige a home.php si la página no existe
      header('Location: /');
      exit;
    }

    extract($layout);

    ob_start();
    include($path);
    $this->content = ob_get_clean();
    
  }

  public function __toString()  {
    return $this->content;
  }
  
}