<?php

namespace ride\application\cache\control;

use ride\library\log\Log;
use ride\library\template\engine\SmartyEngine;
use ride\library\system\file\FileSystem;

use \Exception;

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
     * @var \ride\library\template\engine\SmartyEngine
     */
    private $engine;

    /**
     * Instance of the file system
     * @var \ride\library\system\file\FileSystem
     */
    private $fileSystem;
    private $log;

    /**
     * Constructs a new translation cache control
     * @param \ride\library\template\engine\SmartyEngine $engine
     * @param \ride\library\system\file\FileSystem $fileSystem
     * @param \ride\library\log\Log $log
     * @return null
     */
    public function __construct(SmartyEngine $engine, FileSystem $fileSystem, Log $log = null) {
        $this->engine = $engine;
        $this->fileSystem = $fileSystem;
        $this->log = $log;
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
        $directory = $this->fileSystem->getFile($this->engine->getSmarty()->getCompileDir());
        if (!$directory->exists()) {
            return;
        }

        // sometimes the cache directory is stale through nfs or another server
        // causing this delete call to crash
        try {
            $directory->delete();
        } catch (Exception $exception) {
            if ($this->log) {
                $this->log->logException($exception);
            }
        }
    }

}
