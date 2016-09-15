<?php
namespace T4web\MailTest;

use Zend\Mail\Message;
use T4web\Mail\Assembler;
use T4web\Mail\Template;
use Prophecy\Argument;

class AssemblerTest extends \PHPUnit_Framework_TestCase
{
    public function testAssemble()
    {
        $config = [
            'from-email' => 'support@mail.com',
            'from-name' => 'Support Mail.com',
        ];
        $assembler = new Assembler($config);

        $to = 'max@mail.com';
        $data = [];

        $template = $this->prophesize(Template::class);
        $template->getSubject()->willReturn('Some subject');
        $template->getBody(Argument::type('array'))->willReturn('Some body');
        $message = $assembler->assemble($to, $template->reveal(), $data);

        $this->assertInstanceOf(Message::class, $message);
    }
}
