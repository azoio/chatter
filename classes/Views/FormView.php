<?php

namespace Views;


class FormView extends BaseView
{
    protected $templateFile = 'Templates/form.php';
    protected $source;
    protected $result;

    /**
     * @param $source
     * @param $result
     */
    public function __construct($source, $result)
    {
        $this->source = $source;
        $this->result = $this->formatResult($result);
    }

    private function formatResult($result)
    {
        $result = preg_replace('~^\s+~m', '', $result);
        return $result;
    }
}