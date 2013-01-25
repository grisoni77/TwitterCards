<?php

require_once dirname(__DIR__) . '../src/AbstractTwitterCard.php';
require_once dirname(__DIR__) . '../src/GeneralErrorException.php';

class SummaryTwitterCard extends AbstractTwitterCard
{
    public function __construct()
    {
        parent::__construct();
        $this->setCard('summary');
    }

    public function getProperties()
    {
        if (!$this->validate()) {
            throw new GeneralErrorException('Summary Card non valido', 500);
        } 
        
        // campi obbligatori
        $props = array(
                'twitter:card' => $this->getCard(),
                'twitter:url' => $this->getUrl(),
                'twitter:title' => $this->getTitle(),
                'twitter:description' => $this->getDescription(),
        );
        // campi opzionali
        $image = $this->getImage();
        if (!empty($image)) {
            $props['twitter:image'] = $image;
        }
        $twitter_id = $this->getTwitterId();
        if (!empty($twitter_id)) {
            $props['twitter:site:id'] = $twitter_id;
        }
        $twitter_username = $this->getTwitterUsername();
        if (!empty($twitter_username)) {
            $props['twitter:site'] = $twitter_username;
        }
        
        return $props;
    }
    
    
    public function validate()
    {
        $title = $this->getTitle();
        $url = $this->getUrl();
        $description = $this->getDescription();
        return !empty($title) && !empty($url) && !empty($description);
    }
}
