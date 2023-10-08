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
    protected array $_defaultConfig = [];

    /**
     * parse function
     *
     * @param string $text Source text in Markdown
     * @param boolean $safeMode Whether the safemode will be turned on or off, Default is Off
     * @return string
     */
    public function parse(string $text, bool $safeMode = false): string
    {
        $parsedown = new class($this) extends Parsedown {
            // Override the default behavior of Parsedown

            public static function handleShortcode($pattern, $text, Helper $helper)
            {
                preg_match_all($pattern, $text, $matches);

                foreach ($matches[0] as $key => $value) {
                    try
                    {
                        if (isset($matches[2][$key])) {
                            $response = $helper->getView()->Shortcodes->{$matches[1][$key]}($matches[3][$key]);
                        }
                        else {
                            $response = $helper->getView()->Shortcodes->{$matches[1][$key]}();
                        }
                    } catch (\Exception $e) {
                        throw new \Exception("Shortcode {$matches[1][$key]} not found");
                    }

                    if ($response) {
                        $text = str_replace($value, $response, $text);
                    }

                    // $text = str_replace($value, sprintf("ShortcodeHelper->%s(%s)", $matches[1][$key], $matches[3][$key]), $text);
                }
                
                return $text;
            }
        };

        $parsedown->setSafeMode($safeMode);
        $text = $parsedown::handleShortcode('/{{< (\w+) (\w+)=\"(.*?)\" >}}/s', $text, $this);
        $text = $parsedown::handleShortcode('/{{< (\w+) >}}/s', $text, $this);

        return $parsedown->text($text);
    }
}
