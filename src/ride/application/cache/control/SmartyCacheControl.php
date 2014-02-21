<?php

namespace ride\application\cache\control;

use ride\library\template\engine\SmartyEngine;
use ride\library\system\file\FileSystem;

/**
 * Cache control implementation for Smarty
 */
class SmartyCacheControl extends AbstractCacheControl {

    /**
     * Name of this control
     * @var string
     */
    const NAME = 'smarty';

    /**
     * Instance of the Smarty template engine
     * @var ride\library\template\engine\SmartyEngine
     */
    private $engine;

    /**
     * Instance of the file system
     * @var ride\library\system\file\FileSystem
     */
    private $fileSystem;

    /**
     * Constructs a new translation cache control
     * @param ride\library\template\engine\SmartyEngine $engine
     * @param ride\library\system\file\FileSystem $fileSystem
     * @return null
     */
    public function __construct(SmartyEngine $engine, FileSystem $fileSystem) {
        $this->engine = $engine;
        $this->fileSystem = $fileSystem;
    }

    /**
     * Gets whether this cache is enabled
     * @return boolean
     */
    public function isEnabled() {
        return true;
    }

    /**
	 * Clears this cache
	 * @return null
     */
    public function clear() {
        $directory = $this->fileSystem->getFile($this->engine->getSmarty()->compile_dir);
        if ($directory->exists()) {
            $directory->delete();
        }
    }

}