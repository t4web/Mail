<?php

namespace T4web\Mail\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\Adapter as DbAdapter;

class InitController extends AbstractActionController
{
    /**
     * @var DbAdapter
     */
    private $dbAdapter;

    public function __construct(DbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function onDispatch(MvcEvent $e)
    {
        if (!$e->getRequest() instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $query = "CREATE TABLE IF NOT EXISTS `mail_log` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `mail_from` VARCHAR(100) DEFAULT NULL,
              `mail_to` VARCHAR(100) DEFAULT NULL,
              `subject` VARCHAR(250) DEFAULT NULL,
              `layout_id` INT DEFAULT 0,
              `template_id` INT DEFAULT 0,
              `body` TEXT DEFAULT NULL,
              `calculated_vars` TEXT DEFAULT NULL,
              `created_dt` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->createTable($query);
    }

    private function createTable($query)
    {
        try {
            $this->dbAdapter->query($query, DbAdapter::QUERY_MODE_EXECUTE);
        } catch (\PDOException $e) {
            if (strpos($e->getMessage(), 'table or view already exists') === false) {
                echo $e->getMessage() . PHP_EOL;
                exit(1);
            }
        } catch (\Exception $e) {
            echo  $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }
}
