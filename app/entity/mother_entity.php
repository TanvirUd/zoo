<?php

class Entity
{
    public function hydrate($arrData){
        foreach ($arrData as $key => $value) {
            $strMethod = "set". ucfirst($key);
            if (method_exists($this, $strMethod)) {
                $this->$strMethod($value);
            }
        }
    }
}