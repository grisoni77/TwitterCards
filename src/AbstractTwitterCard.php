<?php
require_once dirname(__DIR__).'../src/GeneralErrorException.php';
require_once dirname(__DIR__).'../src/NonValidInputException.php';

abstract class AbstractTwitterCard
{
    /**
     * twitter:card
     * @var string
     */
    protected $card;
    /**
     * twitter:url
     * @var string
     */
    protected $url;
    /**
     * twitter:title
     * @var string
     */
    protected $title;
    /**
     * twitter:description
     * @var string
     */
    protected $description;
    /**
     * twitter:image
     * @var string
     */
    protected $image;
    
    
    protected $renderer;
    
    public function __construct()
    {
        
    }

    
    public function setCard($card) 
    {
        $this->card = $card;
    }
    
    public function getCard($card)
    {
        return $this->card;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    public function getUrl($url)
    {
        return $this->url;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function getTitle($title)
    {
        return $this->$title;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getDescription($description)
    {
        return $this->description;
    }
    
    public function setImage($image)
    {
        // TODO implementare controllo URL conforme 
        $this->image = $image;
    }
    
    public function getImage($image)
    {
        return $this->image;
    }
    
    
    public function setRenderer($renderer)
    {
        if (!($renderer instanceof TwitterCardRenderer)) {
            throw new NonValidInputException('Puoi assegnare solo un renderer valido', 500);
        } 
        $this->renderer = $renderer;
    }
    
    public function getRenderer()
    {
        return $this->renderer;
    }
    
    public function render()
    {
        if (!isset($this->renderer)) {
            throw new GeneralErrorException('Renderer non associato. Impossibile Renderizzare', 500);
        } 
        return $this->renderer->render($this);
    }
    
}
