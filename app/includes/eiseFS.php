<?php  



Class eiseXLSX_FS {

/** @ignore */
private $path;
/** @ignore */
public $dirs = array();
/** @ignore */
public $filesContent = array();

/** @ignore */
public function __construct($path) {
    $this->path = rtrim($path, eiseXLSX::DS);
    return $this;
}

/** @ignore */
public function get() {
    $this->_scan(eiseXLSX::DS);
    return array($this->dirs, $this->filesContent);
}

/** @ignore */
private function _scan($pathRel) {
    
    if($handle = opendir($this->path . $pathRel)) {
        while(false !== ($item = readdir($handle))) {
            if($item == '..' || $item == '.') {
                continue;
            }
            if(is_dir($this->path . $pathRel . $item)) { 
                $this->dirs[] = ltrim($pathRel, eiseXLSX::DS) . $item;
                $this->_scan($pathRel . $item . eiseXLSX::DS);
            } else {
                $this->filesContent[ltrim($pathRel, eiseXLSX::DS) . $item] = file_get_contents($this->path . $pathRel . $item);
            }
        }
        closedir($handle);
    }
    
}


}