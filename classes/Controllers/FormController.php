<?php

namespace Controllers;

use ReCaptcha\ReCaptcha;
use Views\ChatterView;
use Views\FormView;

class FormController
{
    /**
     * @throws \Exception
     */
    public function show()
    {
        $source   = isset($_POST['source']) ? trim($_POST['source']) : '';
        $errorMsg = '';
        $result   = '';

        if (!empty($source)) {
            try {
                $recaptcha = new ReCaptcha(getenv('RECAPTCHA_SECRET_KEY'));
                $resp      = $recaptcha->verify(
                    isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '',
                    isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null
                );
                if ($resp->isSuccess()) {
                    // if Domain Name Validation turned off don't forget to check hostname field
                    if ($resp->getHostName() !== $_SERVER['SERVER_NAME']) {
                        throw new \Exception('Domain Name Validation false.');
                    }
                }
                else {
                    throw new \Exception('Something went wrong. Please enter reCaptcha and try again.');
                }

                $result = new ChatterView($source);
            }
            catch (\Exception $e) {
                $errorMsg = $e->getMessage();
            }
        }

        echo new FormView(
            $source,
            $result,
            $errorMsg,
            getenv('RECAPTCHA_SITE_KEY')
        );
    }


}

