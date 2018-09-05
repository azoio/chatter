<?php

namespace Views;


class FormView extends BaseView
{
    protected $templateFile = 'Templates/form.php';
    protected $source;
    protected $result;
    protected $errorMsg;
    protected $reCaptchaSiteKey;

    /**
     * @param $source
     * @param $result
     * @param $errorMsg
     * @param $reCaptchaSiteKey
     */
    public function __construct($source, $result, $errorMsg, $reCaptchaSiteKey)
    {
        $this->source           = $source;
        $this->result           = $this->formatResult($result);
        $this->errorMsg         = $errorMsg;
        $this->reCaptchaSiteKey = $reCaptchaSiteKey;
    }

    private function formatResult($result)
    {
        $result = preg_replace('~^\s+~m', '', $result);
        return $result;
    }
}