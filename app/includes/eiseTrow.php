<?php

namespace Core;

/**
 * Throwable class for exceptions.
 * 
 */
Class eiseXLSX_Exception {
    public function __construct($msg) {
          echo $msg;
    }
    public function __toString() {
        return htmlspecialchars($this->getMessage());
    }
}