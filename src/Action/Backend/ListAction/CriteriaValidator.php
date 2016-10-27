<?php

namespace T4web\Mail\Action\Backend\ListAction;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use T4web\Crud\Validator\BaseFilter;

class CriteriaValidator extends BaseFilter
{
    public function __construct()
    {
        $this->inputFilter = new InputFilter();

        $id = new Input('id_equalTo');
        $id->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0]);
        $id->setRequired(false);

        $mailTo = new Input('mailTo_like');
        $mailTo->getFilterChain()
            ->attachByName('StringTrim');
        $mailTo->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 50]);
        $mailTo->setRequired(false);

        $layoutId = new Input('layoutId_equalTo');
        $layoutId->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0, 'max' => 1]);
        $layoutId->setRequired(false);

        $templateId = new Input('templateId_equalTo');
        $templateId->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0, 'max' => 7]);
        $templateId->setRequired(false);

        $limit = new Input('limit');
        $limit->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0]);
        $limit->setRequired(false);

        $page = new Input('page');
        $page->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0]);
        $page->setRequired(false);

        $createdDtLessThen = new Input('createdDt_lessThan');
        $createdDtLessThen->setRequired(false);

        $createdDtGreaterThan = new Input('createdDt_greaterThan');
        $createdDtGreaterThan->setRequired(false);

        $this->inputFilter->add($id);
        $this->inputFilter->add($mailTo);
        $this->inputFilter->add($layoutId);
        $this->inputFilter->add($templateId);
        $this->inputFilter->add($limit);
        $this->inputFilter->add($page);
        $this->inputFilter->add($createdDtLessThen);
        $this->inputFilter->add($createdDtGreaterThan);
    }
}