<?php

namespace pallo\application\cache\control;

use pallo\library\template\engine\SmartyEngine;
use pallo\library\system\file\FileSystem;

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
     * @var pallo\library\template\engine\SmartyEngine
     */
    private $engine;

    /**
     * Instance of the file system
     * @var pallo\library\system\file\FileSystem
     */
    private $fileSystem;

    /**
     * Constructs a new translation cache control
     * @param pallo\library\template\engine\SmartyEngine $engine
     * @param pallo\library\system\file\FileSystem $fileSystem
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