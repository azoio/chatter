<?php

namespace Views\Entities;


class Raw extends AbstractEntity
{
    private $text;

    /**
     * @param $text
     */
    public function __construct($text)
    {
        $this->text =  trim($text);
    }

    public function __toString()
    {
        return $this->text;
    }
}