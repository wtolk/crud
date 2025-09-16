<?php

namespace Wtolk\Crud;

use Illuminate\Support\Facades\File;

class Installer
{
    public static function addToViteConfig()
    {
        $viteConfigPath = base_path('vite.config.js');
        
        if (file_exists($viteConfigPath)) {
            $content = file_get_contents($viteConfigPath);
            
            // Проверяем, не добавлены ли уже ресурсы
            if (!str_contains($content, 'vendor/wtolk/crud')) {
                // Ищем массив input и добавляем в него ресурсы
                $pattern = '/input:\s*\[([^\]]+)\]/s';
                
                if (preg_match($pattern, $content, $matches)) {
                    $currentInputs = trim($matches[1]);
                    // Удаляем закрывающую скобку и добавляем новые ресурсы
                    $newInputs = $currentInputs;
                    if (substr($newInputs, -1) !== ',') {
                        $newInputs .= ',';
                    }
                    $newInputs .= "\n                'public/vendor/wtolk/crud/css/adfm-panel.css',\n                'public/vendor/wtolk/crud/js/admin.js'";
                    
                    $newContent = str_replace($matches[0], "input: [\n                " . $newInputs . "\n            ]", $content);
                    
                    file_put_contents($viteConfigPath, $newContent);
                }
            }
        }
    }
    
    public static function publishAssets()
    {
        // Создаем директорию если не существует
        $publicPath = public_path('vendor/wtolk/crud');
        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0755, true);
        }
        
        // Копируем assets
        static::copyDirectory(__DIR__.'/assets', $publicPath);
    }
    
    protected static function copyDirectory($source, $destination)
    {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        
        $files = scandir($source);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            
            $sourcePath = $source . '/' . $file;
            $destinationPath = $destination . '/' . $file;
            
            if (is_dir($sourcePath)) {
                static::copyDirectory($sourcePath, $destinationPath);
            } else {
                copy($sourcePath, $destinationPath);
            }
        }
    }
}