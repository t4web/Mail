<?php
namespace T4web\MailTest\Action\Backend\ListAction;

use T4web\Mail\Action\Backend\ListAction\CriteriaValidator;
use Prophecy\Argument;

class CriteriaValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidData()
    {
        $data = [
            'id_equalTo' => 1,
            'mailTo_like' => 'recipient%',
            'layoutId_equalTo' => 1,
            'templateId_equalTo' => 1,
            'createdDt_lessThan' => '2016-10-27',
            'createdDt_greaterThan' => '2016-10-30',
            'limit' => 10,
            'page' => 1,
        ];
        $validator = new CriteriaValidator();

        $this->assertTrue($validator->isValid($data));
        $this->assertEquals($data, $validator->getValid());
    }
}
