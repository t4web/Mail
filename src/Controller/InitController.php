<?php

namespace T4web\Mail\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Sql;

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

        $table = new Ddl\CreateTable('mail_templates');
        $table->addColumn(new Ddl\Column\Integer('id', false, null, ['autoincrement' => true]));
        $table->addColumn(new Ddl\Column\Char('name', 100, true));
        $table->addColumn(new Ddl\Column\Integer('type'));
        $table->addColumn(new Ddl\Column\Integer('layout_id'));
        $table->addColumn(new Ddl\Column\Char('subject', 250, true));
        $table->addColumn(new Ddl\Column\Text('body', null, true));
        $table->addColumn(new Ddl\Column\Text('allowed_vars', null, true));
        $table->addColumn(new Ddl\Column\Datetime('dt_created', false, 'NOW()'));
        $table->addColumn(new Ddl\Column\Datetime('dt_updated', false, 'NOW()'));
        $table->addConstraint(new Ddl\Constraint\PrimaryKey('id'));
        $table->addConstraint(new Ddl\Constraint\UniqueKey('name'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query($sql->buildSqlString($table), DbAdapter::QUERY_MODE_EXECUTE);
        } catch (\Exception $e) {
            // currently there are no db-independent way to check if table exists
            // so we assume that table exists when we catch exception
        }


        $table = new Ddl\CreateTable('mail_log');
        $table->addColumn(new Ddl\Column\Integer('id', false, null, ['autoincrement' => true]));
        $table->addColumn(new Ddl\Column\Char('mail_from', 100, true));
        $table->addColumn(new Ddl\Column\Char('mail_to', 100, true));
        $table->addColumn(new Ddl\Column\Char('subject', 250, true));
        $table->addColumn(new Ddl\Column\Integer('layout_id'));
        $table->addColumn(new Ddl\Column\Integer('template_id'));
        $table->addColumn(new Ddl\Column\Text('body', null, true));
        $table->addColumn(new Ddl\Column\Text('calculated_vars', null, true));
        $table->addColumn(new Ddl\Column\Datetime('dt_created', false, 'NOW()'));
        $table->addConstraint(new Ddl\Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query($sql->buildSqlString($table), DbAdapter::QUERY_MODE_EXECUTE);
        } catch (\Exception $e) {
            // currently there are no db-independent way to check if table exists
            // so we assume that table exists when we catch exception
        }
    }
}
