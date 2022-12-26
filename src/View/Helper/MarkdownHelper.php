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

    public function parse(string $text, bool $safeMode = false)
    {
        $parsedown = new Parsedown();
        $parsedown->setSafeMode($safeMode);

        return $parsedown->text($text);
    }
}
