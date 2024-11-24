<?php
if (!class_exists('Picture')) {
    class Picture {
        private $imagePath;
        private $mobileImagePath;
        private $attributes;
        private $defaultAttributes;
        private $mode;

        public function __construct($imagePath, $mobileImagePath = null) {
            $this->mode = defined('MODE') ? MODE : 'php';
            $baseAssets = defined('ASSETS') ? ASSETS : ($this->mode === 'php' ? 'public/' : '');
            $this->imagePath = $baseAssets . ltrim($imagePath, '/');
            $this->mobileImagePath = $mobileImagePath ? $baseAssets . ltrim($mobileImagePath, '/') : null;
            $this->defaultAttributes = [
                'alt' => '',
                'lazy' => true,
                'width' => null,
                'height' => null,
                'role' => null,
                'style' => null,
                'fetchpriority' => 'low',
                'forceWebP' => false,
                'class' => '',
                'mobileBreakpoint' => '768px',
                'data' => []
            ];
            $this->attributes = $this->defaultAttributes;
            return $this;
        }

        public function set($key, $value) {
            if (array_key_exists($key, $this->attributes)) {
                $this->attributes[$key] = $value;
            } elseif (strpos($key, 'data-') === 0) {
                $dataKey = substr($key, 5);
                $this->attributes['data'][$dataKey] = $value;
            }
            return $this;
        }

        public function generate($echo = false) {
            $imagePath = $this->imagePath;
            $sizeCheckPath = $this->mode === 'html' ? 'public/' . $imagePath : $imagePath;
            
            if (is_null($this->attributes['width']) || is_null($this->attributes['height'])) {
                if (file_exists($sizeCheckPath)) {
                    list($this->attributes['width'], $this->attributes['height']) = getimagesize($sizeCheckPath);
                }
            }
        
            $alt_stripped = htmlspecialchars(strip_tags($this->attributes['alt']), ENT_QUOTES);
        
            $markup = "<picture>\n";
        
            if ($this->mobileImagePath) {
                $markup .= "<source srcset='{$this->mobileImagePath}' media='(max-width: {$this->attributes['mobileBreakpoint']})'>\n";
            }
        
            $imagePathWithoutExtension = pathinfo($imagePath, PATHINFO_DIRNAME) . '/' . pathinfo($imagePath, PATHINFO_FILENAME);
            $webpImagePath = $imagePathWithoutExtension . '.webp';
            
            $webpCheckPath = $this->mode === 'html' ? 'public/' . $webpImagePath : $webpImagePath;
            
            if ($this->attributes['forceWebP'] || file_exists($webpCheckPath)) {
                $markup .= "<source srcset='{$webpImagePath}' type='image/webp'>\n";
            }
        
            $imgAttributes = [
                'class' => $this->attributes['class'],
                'src' => $imagePath,
                'alt' => $alt_stripped,
                'title' => $alt_stripped,
                'loading' => $this->attributes['lazy'] ? 'lazy' : null,
                'decoding' => 'async',
                'width' => $this->attributes['width'],
                'height' => $this->attributes['height'],
                'fetchpriority' => $this->attributes['fetchpriority']
            ];

            if ($this->attributes['role']) {
                $imgAttributes['role'] = $this->attributes['role'];
            }

            if ($this->attributes['style']) {
                $imgAttributes['style'] = $this->attributes['style'];
            }

            foreach ($this->attributes['data'] as $key => $value) {
                $imgAttributes["data-$key"] = $value;
            }

            $attributeString = '';
            foreach ($imgAttributes as $key => $value) {
                if ($value !== null && $value !== '') {
                    $attributeString .= " $key='" . htmlspecialchars($value, ENT_QUOTES) . "'";
                }
            }
        
            $markup .= "<img{$attributeString} />\n";
            $markup .= "</picture>";
        
            if ($echo) {
                echo $markup;
                return $this;
            }
            return $markup;
        }
    }
}