<?php

class Entity
{
    /**
     * Hydrates the object with data from an array.
     *
     * @param array $arrData The array containing the data to hydrate the object with.
     * @return void
     */
    public function hydrate($arrData){
        foreach ($arrData as $key => $value) {
            $strMethod = "set". ucfirst($key);
            if (method_exists($this, $strMethod)) {
                $this->$strMethod($value);
            }
        }
    }
}