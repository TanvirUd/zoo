<?php

class MotherCtrl
{
    protected array $_data;

    /**
     * Renders the view based on the provided data.
     *
     * This method iterates over the data array and assigns each value to a variable with the corresponding key.
     * It then determines the location of the view file based on the current page and includes it.
     * If the view file does not exist, it includes the 404.php file instead.
     *
     * @return void
     */
    public function render(){
        foreach ($this->_data as $key => $value) {
            $$key = $value;
        }
 
        require("../app/view/partials/header.php");

        $pageLocate = "../app/view/view_" . $page . ".php";
        if(file_exists($pageLocate)){
            require($pageLocate);
        } else {
           // require("../app/view/404.php");
        }

        require("../app/view/partials/footer.php");
    }
}