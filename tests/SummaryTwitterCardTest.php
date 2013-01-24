<?php

require_once dirname(__DIR__).('../src/TwitterCardFactory.php');
require_once dirname(__DIR__).('../src/TwitterCardRenderer.php');

class SummaryTwitterCardTest extends PHPUnit_Framework_TestCase
{
    protected $card;
    
    public function setUp()
    {
        $this->card = TwitterCardFactory::create('summary');
    }
    
    
    public function testGetImage()
    {
        $card = $this->card;
        $img = 'https://www.google.it/images/srpr/logo3w.png'; 
        $card->setImage($img);
        $this->assertEquals($img, $card->getImage());
    }
    
    /**
     * @expectedException NonValidInputException
     */
    public function testSetNonValidImage()
    {
        $card = $this->card;
        $img = 'questa non è una url valida';
        $card->setImage($img);
    }

    public function testRenderCard()
    {
        $card = $this->card;
        $output = $card->render();
        // assert is empty (card is empty)
        $this->assertTrue(empty($output));
    }

    /**
     * @expectedException GeneralErrorException
     */
    public function testRenderCardWithoutRenderer()
    {
        require_once dirname(__DIR__).('../src/SummaryTwitterCard.php');
        $card = new SummaryTwitterCard();
        $output = $card->render();
    }
    
    public function testSetRenderer()
    {
        $card = $this->card;
        $renderer = new FakeRenderer();
        $card->setRenderer($renderer);
        $this->assertSame($renderer, $card->getRenderer());
    }
    
    /**
     * @expectedException NonValidInputException
     */
    public function testSetNonValidRenderer()
    {
        $card = $this->card;
        $renderer = new stdClass();
        $card->setRenderer($renderer);
    }
    
    public function testRenderWithRenderer()
    {
        $card = $this->card;
        $renderer = new FakeRenderer(); 
        $card->setRenderer($renderer);
        $output = $card->render();
        $this->assertEquals('ciupa', $output);
    }
    
}


class FakeRenderer extends TwitterCardRenderer
{
    public function render($card)
    {
        return 'ciupa';
    }
}
