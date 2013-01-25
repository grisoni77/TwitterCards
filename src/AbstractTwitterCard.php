<?php
require_once dirname(__DIR__) . '../src/GeneralErrorException.php';
require_once dirname(__DIR__) . '../src/NonValidInputException.php';

/**
 * @see https://dev.twitter.com/docs/cards
 */
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
    /**
     * twitter:site:id
     * @var string
     */
    protected $twitterId;
    /**
     * twitter:site:username
     * @var string
     */
    protected $twitterUsername;

    protected $renderer;

    public function __construct()
    {

    }

    public function setCard($card)
    {
        $this->card = $card;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setImage($image)
    {
        // TODO implementare controllo URL conforme 
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return the string
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }

    /**
     * @param  $twitterId
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
    }

    /**
     * @return the string
     */
    public function getTwitterUsername()
    {
        return $this->twitterUsername;
    }

    /**
     * @param  $twitterUsername
     */
    public function setTwitterUsername($twitterUsername)
    {
        $this->twitterUsername = $twitterUsername;
    }

    /**
     * Ritorna array con property del card da pubblicare
     * (variano a seconda del tipo di card)
     * @return array
     */
    abstract public function getProperties();

    /**
     * Controlla che tutti i valori necessari siano stati impostati
     * (variano a seconda del tipo di card)
     * @return boolean
     */
    abstract public function validate();

    public function setRenderer($renderer)
    {
        if (!($renderer instanceof TwitterCardRenderer)) {
            throw new NonValidInputException(
                    'Puoi assegnare solo un renderer valido', 500);
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
            throw new GeneralErrorException(
                    'Renderer non associato. Impossibile Renderizzare', 500);
        }
        return $this->renderer->render($this);
    }

}
