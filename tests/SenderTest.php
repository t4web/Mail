<?php
namespace T4web\MailTest;

use Zend\Mail\Transport\TransportInterface;
use Zend\Mail\Message;
use Zend\EventManager\EventManager;
use Zend\EventManager\Event;
use T4web\Mail\Sender;
use T4web\Mail\Assembler;
use T4web\Mail\TemplateBuilder;
use T4web\Mail\Template;
use Prophecy\Argument;

class SenderTest extends \PHPUnit_Framework_TestCase
{
    // tests
    public function testSend()
    {
        $transport = $this->prophesize(TransportInterface::class);
        $templateBuilder = $this->prophesize(TemplateBuilder::class);
        $assembler = $this->prophesize(Assembler::class);
        $eventManager = $this->prophesize(EventManager::class);

        $sender = new Sender(
            $transport->reveal(),
            $templateBuilder->reveal(),
            $assembler->reveal(),
            $eventManager->reveal()
        );

        $to = 'max@mail.com';
        $templateName = 'feedback-answer';
        $data = [];

        $template = $this->prophesize(Template::class);
        $templateBuilder->get($templateName)->willReturn($template->reveal());

        $message = $this->prophesize(Message::class);
        $assembler->assemble($to, $template, $data)->willReturn($message->reveal());
        $transport->send(Argument::type(Message::class))->willReturn(true);
        $eventManager->trigger(Argument::type(Event::class))->willReturn(true);

        $sender->send($to, $templateName, $data);
    }
}
