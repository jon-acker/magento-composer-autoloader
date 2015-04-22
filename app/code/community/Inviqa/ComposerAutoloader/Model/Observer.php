<?php

class Inviqa_ComposerAutoloader_Model_Observer
{
    public function includeAutoloader()
    {
        Mage::helper('inviqa_composer_autoload/autoloader')->includeAutoloader();
    }
}
