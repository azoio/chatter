<?php

namespace Views;

class BaseView
{
    protected $templateFile = '';
    protected $styles       = [];

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        if (empty($this->templateFile) || !is_file($this->templateFile)) {
            throw new \Exception('Template file not found.');
        }

        ob_start();
        require $this->templateFile;
        return ob_get_clean();
    }

    /**
     * @return string
     */
    protected function loadStyles()
    {
        $result = '';
        $styles = (array)$this->styles;
        foreach ($styles as $style) {
            if (is_file($style)) {
                $result .= @file_get_contents($style);
            }
        }
        $result = preg_replace('~(/\*.*?\*/)|\r|\n|\t~s', ' ', $result);
        $result = preg_replace('~\s{2,}~s', ' ', $result);
        return $result;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function __toString()
    {
        try {
            return $this->render();
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
