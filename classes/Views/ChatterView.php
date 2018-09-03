<?php

namespace Views;


use Views\Entities\Head;
use Views\Entities\Raw;
use Views\Entities\Text;

class ChatterView extends BaseView
{
    protected $templateFile = 'Templates/chatter.php';
    protected $styles       = [
        'Templates/styles.css',
    ];
    protected $lines        = [];

    /**
     * @param $source
     */
    public function __construct($source)
    {
        $this->lines = $this->createLines($source);
    }

    private function createLines($source)
    {
        $source = $this->prepareSource($source);
        $source = $this->explodeSource($source);

        if (empty($source)) {
            return [];
        }

        $lines = [];

        foreach ($source as $sourceLine) {
            $sourceLine = trim($sourceLine);
            if (empty($sourceLine)) {
                continue;
            }

            if (
                ($sourceLine[0] != '<')
                ||
                (strncmp($sourceLine, '<strong', 7) == 0)
            ) {
                $lines = array_merge($lines, $this->explodeLine($sourceLine));
                continue;
            }

            if (
                in_array(substr($sourceLine, 0, 2), ['<p', '</'])
                ||
                (strncmp($sourceLine, '<br', 3) == 0)

            ) {
                continue;
            }

            if (preg_match('~^<h\d+~i', $sourceLine)) {
                $lines[] = new Head($sourceLine);
                continue;
            }

            $lines[] = new Raw($sourceLine);
        }

        return $lines;
    }

    /**
     * @param $text
     * @return array
     */
    protected function explodeLine($text)
    {
        $text = preg_replace_callback('~'
            . '(<a [^>]+?>.*?</a>)'
            . '|'
            . '(<strong[^>]*>.*?</strong>)'
            . '~is', function ($matches) {
            return '{{' . base64_encode($matches[0]) . '}}';
        }, $text);

        $text = preg_split('~([;:?!.])\s~s', $text, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        // implode lines with number (1.) & next line
        if (
            (count($text) > 2)
            && ($text[1] == '.')
            && preg_match('~^#?\d+\s*~', $text[0])
        ) {
            $line = array_shift($text) . array_shift($text) . ' ' . array_shift($text);
            array_unshift($text, $line);
        }

        foreach ($text as &$line) {
            $line = preg_replace_callback('~{{(.*?)}}~i', function ($matches) {
                return base64_decode($matches[0]);
            }, $line);
        }

        $result = [];
        while (!empty($text)) {
            $result[] = new Text(array_shift($text) . (!empty($text) ? array_shift($text) : ''));
        }

        return $result;
    }

    /**
     * @param $source
     * @return array
     */
    protected function explodeSource($source)
    {
        $source = preg_split('~\s*'
            . '(<h\d+[^>]*?>.*?</h\d+>)'
            . '|'
            . '(<p[^>]*?>)|(</p>)'
            . '|'
            . '<br[^>]*?>'
            . '|'
            . '(<img[^>]*?>(\s*</img>)?)'
            . '|'
            . '(<div[^>]*?>.*?</div>)'
            . '|'
            . '(<iframe[^>]*?>.*?</iframe>)'
            . '\s*~is', $source, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        return $source;
    }

    /**
     * @param $source
     * @return string
     */
    private function prepareSource($source)
    {
        $source = preg_replace('/\t|&nbsp;|\x{0020}|\x{00A0}|[\x{2002}-\x{2006}]|\x{2009}|\x{200A}/u', ' ', $source);

        return $source;
    }

}