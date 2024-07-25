<?php

class Entity
{
    protected string $_strPrefixe = "";

    public function hydrate($arrData){
        foreach ($arrData as $key => $value) {
            $strMethod = "set".ucfirst(str_replace($this->_strPrefixe, "", $key));
            if (method_exists($this, $strMethod)) {
                $this->$strMethod($value);
            }
        }
    }
}