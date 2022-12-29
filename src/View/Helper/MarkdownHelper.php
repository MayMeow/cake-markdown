<?php
declare(strict_types=1);

namespace Markdown\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use \Parsedown;

/**
 * Markdown helper
 */
class MarkdownHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    /**
     * parse function
     *
     * @param string $text Source text in Markdown
     * @param boolean $safeMode Whether the safemode will be turned on or off, Default is Off
     * @return string
     */
    public function parse(string $text, bool $safeMode = false): string
    {
        $parsedown = new Parsedown();
        $parsedown->setSafeMode($safeMode);

        return $parsedown->text($text);
    }
}
