<?php

class Inviqa_ComposerAutoloader_Helper_Autoloader extends Mage_Core_Helper_Abstract
{
    const COMPOSER_CONFIG_XML_PATH = 'composer/options/composerautoloader_path';

    /**
     * @var boolean
     */
    private $loaded = false;

    /**
     * @return string
     * @throws Mage_Core_Exception
     */
    private function getComposerAutoloaderPath()
    {
        $autoloaderPath = Mage::getBaseDir() . '/' .
            (string) Mage::getConfig()->getNode(self::COMPOSER_CONFIG_XML_PATH, 'default');

        if (!(is_file($autoloaderPath) && is_readable($autoloaderPath))) {
            Mage::throwException('Could not find or read autoloader in ' . $autoloaderPath);
        }

        return $autoloaderPath;
    }

    /**
     * @throws Mage_Exception
     */
    public function includeAutoloader()
    {
        if ($this->loaded) {
            return;
        }

        $composerClassLoader = require_once $this->getComposerAutoloaderPath();

        // can be true if already included
        if (!($composerClassLoader instanceof \Composer\Autoload\ClassLoader || $composerClassLoader)) {
            Mage::throwException('Invalid composer autoloader (expected Composer\Autoload\ClassLoader)');
        }

        $this->loaded = true;
    }
}
