<?php
namespace T4web\MailTest;

use Zend\EventManager\EventInterface;
use Zend\Mail\Message;
use Zend\Mail\AddressList;
use Zend\Mime\Message as MimeMessage;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4web\Mail\Listener\LogSending;
use T4web\Mail\Template;
use T4web\Mail\Domain\MailLogEntry\MailLogEntry;
use Prophecy\Argument;

class LogSendingTest extends \PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        $repository = $this->prophesize(RepositoryInterface::class);
        $listener = new LogSending($repository->reveal());

        $event = $this->prophesize(EventInterface::class);

        $message = $this->prophesize(Message::class);
        $event->getParam('message')->willReturn($message->reveal());

        $template = $this->prophesize(Template::class);
        $event->getParam('template')->willReturn($template->reveal());

        $to = new AddressList();
        $to->addFromString('reciever@mail.com');
        $message->getTo()->willReturn($to);

        $from = new AddressList();
        $from->addFromString('sender@mail.com');
        $message->getFrom()->willReturn($from);

        $message->getSubject()->willReturn('Some subject');
        $template->getLayoutId()->willReturn(Template::LAYOUT_DEFAULT);
        $template->getId()->willReturn(Template::FEEDBACK_ANSWER);
        $mimeMessage = new MimeMessage();
        $mimeMessage->addPart(new \Zend\Mime\Part('some body'));
        $message->getBody()->willReturn($mimeMessage);
        $event->getParam('data')->willReturn(['data' => 'x']);
        $repository->add(Argument::type(MailLogEntry::class));

        $listener->__invoke($event->reveal());
    }
}
