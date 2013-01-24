<?php

require_once dirname(__DIR__).'../src/TwitterCardFactory.php';
 
class TwitterCardFactoryTest extends PHPUnit_Framework_TestCase
{
    
    public function testCreateSummary()
    {
        $card = TwitterCardFactory::create('summary');
        $this->assertTrue($card instanceof SummaryTwitterCard); 
    }

    /**
     * @expectedException    NonExistentCardException
     * @expectedMessage      This Twitter Card type is not supported      
     */
    public function testCreateNonExistentCardType()
    {
        $card = TwitterCardFactory::create('inventato_da_me');
    }
    
    public function testDefaultRenderer()
    {
        $card = TwitterCardFactory::create('summary');
        $renderer = $card->getRenderer();
        $this->assertTrue($renderer instanceof TwitterCardRenderer);
    }
    
}