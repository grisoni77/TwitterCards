<?php

require_once dirname(__DIR__).'../src/NonExistentCardException.php';
require_once dirname(__DIR__).'../src/TwitterCardRenderer.php';

class TwitterCardFactory
{
    protected static $supported_types = array(
            'summary'
    );
    
    public static function create($type) 
    {
        // se non esiste lancia un eccezione
        if (!in_array($type, self::$supported_types)) {
            throw new NonExistentCardException('Questo tipo non esiste', 400);
        }
        
        // costruisce nome classe e require sorgente
        $className = ucfirst($type).'TwitterCard';
        require_once dirname(__DIR__).'../src/'.$className.'.php';
        
        // get instance
        $card = new $className();
        
        // set default renderer
        $renderer = new TwitterCardRenderer();
        $card->setRenderer($renderer);
        
        // return
        return $card;
    }
}
