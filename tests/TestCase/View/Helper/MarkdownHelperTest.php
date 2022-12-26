<?php
declare(strict_types=1);

namespace Markdown\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Markdown\View\Helper\MarkdownHelper;

/**
 * Markdown\View\Helper\MarkdownHelper Test Case
 */
class MarkdownHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Markdown\View\Helper\MarkdownHelper
     */
    protected $Markdown;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Markdown = new MarkdownHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Markdown);

        parent::tearDown();
    }
}
