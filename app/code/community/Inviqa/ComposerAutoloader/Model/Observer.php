<?php

use Composer\Autoload\ClassLoader;

class Inviqa_ComposerAutoloader_Model_Observer
{
    /**
     * @var boolean
     */
    private $loaded = false;

    /**
     * Load composers autoloader if found
     *
     * @throws Mage_Exception
     */
    public function initialise()
    {
        if ($this->loaded) {
            return;
        }

        $autoloaderPath  = Mage::getBaseDir() . '/' .
            (string) Mage::getConfig()->getNode('default')->composer->composerautoloader->composerautoloader_path;

        if (!file_exists($autoloaderPath)) {
            throw new Mage_Exception('Could not find autoloader in ' . $autoloaderPath);
        }

        $composer = require_once($autoloaderPath);

        if (!($composer instanceof ClassLoader)) {
            throw new Mage_Exception('Invalid composer autoloader (expected Composer\Autoload\ClassLoader)');
        }

        $this->loaded = true;
    }
}
