<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianFeldmann\CaptainHook\Hook\Message\Rule;

use SebastianFeldmann\Git\CommitMessage;

class LimitBodyLineLengthTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests LimitBodyLineLength::pass
     */
    public function testPassSuccess()
    {
        $msg  = new CommitMessage('Foo' . PHP_EOL . PHP_EOL . 'Bar');
        $rule = new LimitBodyLineLength(10);
        $this->assertTrue($rule->pass($msg));
    }

    /**
     * Tests LimitBodyLineLength::pass
     */
    public function testPassFail()
    {
        $msg  = new CommitMessage('Foo' . PHP_EOL . PHP_EOL . 'Bar Baz Fiz Baz');
        $rule = new LimitBodyLineLength(10);
        $this->assertFalse($rule->pass($msg));
    }

    /**
     * Tests LimitBodyLineLength::pass
     */
    public function testPassFailOnAnyLine()
    {
        $msg  = new CommitMessage('Foo' . PHP_EOL . PHP_EOL . 'Fooish' . PHP_EOL . 'Bar Baz Fiz Baz');
        $rule = new LimitBodyLineLength(10);
        $this->assertFalse($rule->pass($msg));
    }
}
