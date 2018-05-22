<?php

namespace XCasts\Markdown;

/**
 * Class Markdown
 *
 * @package XCasts\Markdown
 */
class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     *
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function toHtml($markdownText)
    {
        $html = $this->parser->makeHtml($markdownText);

        return $html;
    }

}