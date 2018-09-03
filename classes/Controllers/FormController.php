<?php

namespace Controllers;

use Views\ChatterView;
use Views\FormView;

class FormController
{
    /**
     * @throws \Exception
     */
    public function show()
    {
        $source = isset($_POST['source']) ? trim($_POST['source']) : '';

        $result = !empty($source) ? new ChatterView($source) : '';

        echo new FormView($source, $result);
    }


}

