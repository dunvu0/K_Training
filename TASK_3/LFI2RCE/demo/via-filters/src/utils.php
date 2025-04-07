<?php

class RCE{
    public $cmd;
    public function __destruct()
    {
        system($this->cmd);
    }
}

?>