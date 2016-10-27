<?php

namespace T4web\Mail\Domain\MailLogEntry;

use T4webDomain\Entity;

class MailLogEntry extends Entity
{
    /**
     * @var string
     */
    protected $mailFrom;

    /**
     * @var string
     */
    protected $mailTo;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var int
     */
    protected $layoutId;

    /**
     * @var int
     */
    protected $templateId;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var array
     */
    protected $calculatedVars;

    /**
     * @var string
     */
    protected $createdDt;

    public function populate(array $array = [])
    {
        if ($this->id === null && empty($array['id'])) {
            if (empty($array['createdDt'])) {
                $array['createdDt'] = date('Y-m-d H:i:s.u');
            }
        }

        if (isset($array['calculatedVars']) && is_array($array['calculatedVars'])) {
            $array['calculatedVars'] = json_encode($array['calculatedVars']);
        }

        return parent::populate($array);
    }
}
