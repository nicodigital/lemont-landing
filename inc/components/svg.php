<?php

// $loader = new SVGLoader();

// Añadir una sola clase
// $loader->loadSVG('public/img/map.svg', 'my-svg-class');

// Añadir múltiples clases como string
// $loader->loadSVG('public/img/map.svg', 'class1 class2 class3');

// Añadir múltiples clases como array
// $loader->loadSVG('public/img/map.svg', ['class1', 'class2', 'class3']);

// Añadir clases y atributos data
// $loader->loadSVG('public/img/map.svg', 'my-class', [
//     'id' => '123',
//     'name' => 'main-map',
//     'section' => 'header'
// ]);


class SVGLoader {
    private $lastError = '';
    private $mode;

    public function __construct() {
        $this->mode = defined('MODE') ? MODE : 'php';
    }

    public function loadSVG(string $path, $classes = null, array $dataAttributes = null) {
        $baseAssets = defined('ASSETS') ? ASSETS : ($this->mode === 'php' ? 'public/' : '');
        $fullPath = $baseAssets . ltrim($path, '/');
        $checkPath = $this->mode === 'html' ? 'public/' . ltrim($path, '/') : $fullPath;

        if (filter_var($fullPath, FILTER_VALIDATE_URL)) {
            $svgContent = @file_get_contents($fullPath);
        } else {
            if (!file_exists($checkPath)) {
                $this->lastError = 'Archivo no encontrado';
                return false;
            }
            $svgContent = @file_get_contents($checkPath);
        }
        
        if ($svgContent === false) {
            $this->lastError = 'No se pudo cargar el archivo SVG';
            return false;
        }
        
        if (!preg_match('/<svg[^>]*>.*<\/svg>/is', $svgContent)) {
            $this->lastError = 'El archivo no contiene un SVG válido';
            return false;
        }
        
        $cleanSvg = $this->sanitizeSVG($svgContent);
        
        $doc = new DOMDocument();
        $doc->loadXML($cleanSvg);
        $svgElement = $doc->getElementsByTagName('svg')->item(0);
        
        if ($svgElement) {
            if ($classes !== null) {
                $newClasses = $this->formatClasses($classes);
                $existingClasses = $svgElement->getAttribute('class');
                
                if ($existingClasses) {
                    $allClasses = array_unique(
                        array_filter(
                            array_merge(
                                explode(' ', $existingClasses),
                                explode(' ', $newClasses)
                            )
                        )
                    );
                    $svgElement->setAttribute('class', implode(' ', $allClasses));
                } else {
                    $svgElement->setAttribute('class', $newClasses);
                }
            }
            
            if ($dataAttributes !== null) {
                foreach ($dataAttributes as $name => $value) {
                    $attributeName = $this->formatDataAttributeName($name);
                    $svgElement->setAttribute($attributeName, $value);
                }
            }
        }
        
        $result = $doc->saveXML($doc->documentElement);
        
        if ($this->mode === 'html') {
            $result = str_replace('public/', '', $result);
        }
        
        return $result;
    }

    private function sanitizeSVG(string $svg): string {
        $svg = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $svg);
        $svg = preg_replace('/\bon\w+\s*=\s*(["\']).*?\1/i', '', $svg);
        $svg = preg_replace('/href\s*=\s*(["\'])javascript:.*?\1/i', '', $svg);
        
        if (!strpos($svg, 'xmlns="http://www.w3.org/2000/svg"')) {
            $svg = preg_replace('/<svg/', '<svg xmlns="http://www.w3.org/2000/svg"', $svg);
        }
        
        return $svg;
    }
    
    private function formatClasses($classes): string {
        if ($classes === null) {
            return '';
        }
        
        if (is_array($classes)) {
            return implode(' ', array_filter($classes));
        }
        
        return trim(preg_replace('/\s+/', ' ', $classes));
    }
    
    private function formatDataAttributeName(string $name): string {
        if (strpos($name, 'data-') !== 0) {
            $name = 'data-' . $name;
        }
        
        $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));
        
        return $name;
    }
    
    public function getLastError(): string {
        return $this->lastError;
    }
}