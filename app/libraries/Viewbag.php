<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewbag extends StdClass {
    public function __get($name)
    {
        if (array_key_exists($name, $this)) {
            return $this[$name];
        }

        return '';
    }
}