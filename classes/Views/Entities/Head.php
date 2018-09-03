<?php

namespace Views\Entities;

class Head extends AbstractEntity
{
    private $text;

    /**
     * @param $text
     */
    public function __construct($text)
    {
        $this->text = trim(preg_replace('~<h\d+[^>]*?>(.*)</h\d+>~is', '$1', $text));
    }

    public function __toString()
    {
        return $this->text;
    }
}