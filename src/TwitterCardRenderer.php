<?php

class TwitterCardRenderer
{
    /**
     * @return mixed 
     * @param AbstractTwitterCard $card
     */
    public function render($card)
    {
        $properties = $card->getProperties();
        $meta = ''; 
        foreach ($properties as $name => $value) 
        {
            $meta .= sprintf('<metadata name="%s" content="%s" />', $name, $value);
        }
        
        return $meta;
    }
}
