<?php 
class HTMLCache
{
    private $enabled;
    private $output;
    private $page;
    private $excludedExtensions = ['ico', 'css', 'svg', 'js', 'png', 'jpg', 'jpeg', 'gif'];

    public function __construct($mode, $page)
    {
        $this->enabled = ($mode === 'html');
        $this->page = $page === 'home' ? 'index' : $page;

        if ($this->enabled && !$this->isStaticResource()) {
            ob_start();
        }
    }

    public function generate()
    {
        if ($this->enabled && !$this->isStaticResource()) {
            $this->output = ob_get_contents();
            ob_end_clean();
            $this->saveFile();
        } else {
            ob_end_flush();
        }
    }

    private function saveFile()
    {
        // Obtener la ruta solicitada
        $requestUri = $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($requestUri);
        $path = trim($parsedUrl['path'], '/'); // Eliminar cualquier barra inicial o final
        
        // Manejar la generación de subdirectorios para idiomas
        if ($path) {
            $parts = explode('/', $path);
            
            // Si la URL es solo el idioma, como "en" o "es", configurar para crear un index.html
            if (count($parts) === 1) {
                $directory = 'public/' . $parts[0];
                $filename = 'index';
            } else {
                $directory = 'public/' . implode('/', array_slice($parts, 0, -1));
                $filename = end($parts);
            }
        } else {
            $directory = 'public';
            $filename = 'index';
        }
        
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filePath = $directory . '/' . $filename . '.html';
        file_put_contents($filePath, $this->output);
    }

    private function isStaticResource()
    {
        $pathInfo = pathinfo($_SERVER['REQUEST_URI']);
        $extension = isset($pathInfo['extension']) ? strtolower($pathInfo['extension']) : '';

        return in_array($extension, $this->excludedExtensions);
    }
}
