<?php

namespace T4web\Mail;

return [
    'contents' => [
        'admin-MailLogEntry-list' => [
            'extend' => 'admin-list',
            'data' => [
                'static' => [
                    'title' => 'Mail log',
                    'icon' => 'fa-envelope',
                ],
            ],
            'children' => [
                'filter' => [
                    'extend' => 't4web-admin-filter',
                    'data' => [
                        'static' => [
                            'horizontal' => true,
                        ],
                    ],
                    'children' => [
                        'filter-id' => [
                            'template' => 't4web-admin/block/form-element-text',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'id_equalTo',
                                    'label' => 'Id',
                                ],
                                'fromParent' => [
                                    'id_equalTo' => 'value'
                                ],
                            ],
                        ],
                        'filter-to' => [
                            'template' => 't4web-admin/block/form-element-text',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'mailTo_like',
                                    'label' => 'To',
                                ],
                                'fromParent' => [
                                    'mailTo_like' => 'value'
                                ],
                            ],
                        ],
                        'filter-layout' => [
                            'template' => 't4web-admin/block/form-element-select',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'layoutId_equalTo',
                                    'label' => 'Layout',
                                    'options' =>  [
                                        '' => "All",
                                        Template::LAYOUT_DEFAULT => "default",
                                    ],
                                ],
                                'fromParent' => [
                                    'layoutId_equalTo' => 'value'
                                ],
                            ],
                        ],
                        'filter-template' => [
                            'template' => 't4web-admin/block/form-element-select',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'templateId_equalTo',
                                    'label' => 'Template',
                                    'options' =>  [
                                        '' => 'All',
                                        Template::FEEDBACK_ANSWER => 'feedback-answer',
                                    ],
                                ],
                                'fromParent' => [
                                    'templateId_equalTo' => 'value'
                                ],
                            ],
                        ],
                        'filter-date' => [
                            'template' => 't4web-admin/block/form-element-datetime-range',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'createdDt',
                                    'label' => 'Create date range',
                                ],
                                'fromParent' => [
                                    'createdDt_lessThan' => 'lessThen',
                                    'createdDt_greaterThan' => 'greaterThen',
                                ]
                            ],
                        ],
                        'form-button-clear' => [
                            'data' => [
                                'static' => [
                                    'routeName' => 'admin-MailLogEntry-list',
                                ],
                            ],
                        ],
                    ],
                ],
                'table' => [
                    'capture' => 'table',
                    'template' => 't4web-admin/block/table',
                    'viewModel' => \T4web\Admin\ViewModel\TableViewModel::class,
                    'data' => [
                        'fromGlobal' => [
                            'result' => 'rowsData',
                        ],
                    ],
                    'children' => [
                        'table-head-row' => [
                            'template' => 't4web-admin/block/table-tr',
                            'data' => [
                                'fromParent' => 'rows',
                            ],
                            'children' => [
                                'table-th-id' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Id',
                                            'width' => '5%',
                                        ],
                                    ],
                                ],
                                'table-th-to' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'To',
                                            'width' => '20%',
                                        ],
                                    ],
                                ],
                                'table-th-subject' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Subject',
                                            'width' => '35%',
                                        ],
                                    ],
                                ],
                                'table-th-layout' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Layout',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-template' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Template',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-created-dt' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Created date',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-extras' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Vars',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'table-body-row' => [
                            'viewModel' => \T4web\Admin\ViewModel\TableRowViewModel::class,
                            'template' => 't4web-admin/block/table-tr-collapse',
                            'data' => [
                                'fromParent' => 'row',
                            ],
                            'children' => [
                                'table-td-id' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['id' => 'value'],
                                    ],
                                ],
                                'table-td-to' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['mailTo' => 'value'],
                                    ],
                                ],
                                'table-td-subject' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['subject' => 'value'],
                                    ],
                                ],
                                'table-td-layout' => [
                                    'template' => 't4web-admin/block/table-td-labeled',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'textValueMap' => [
                                                1 => 'default',
                                            ],
                                        ],
                                        'fromParent' => ['layoutId' => 'value'],
                                    ],
                                ],
                                'table-td-template' => [
                                    'template' => 't4web-admin/block/table-td-labeled',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'textValueMap' => [
                                                2 => 'forgot-password',
                                            ],
                                        ],
                                        'fromParent' => ['templateId' => 'value'],
                                    ],
                                ],
                                'table-td-created-dt' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['createdDt' => 'value'],
                                    ],
                                ],
                                'table-td-buttons' => [
                                    'template' => 't4web-admin/block/table-td-buttons',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => 'id',
                                    ],
                                    'children' => [
                                        'show-button' => [
                                            'template' => 't4web-admin/block/link-button',
                                            'capture' => 'button',
                                            'data' => [
                                                'static' => [
                                                    'size' => 'xs',
                                                    'color' => 'info',
                                                    'text' => 'Show',
                                                    'routeName' => 'admin-MailLogEntry-list'
                                                ],
                                                'fromParent' => [
                                                    'id' => 'target'
                                                ],
                                            ],
                                        ],
                                        'collapse-button' => [
                                            'template' => 't4web-admin/block/collapse-button',
                                            'capture' => 'button',
                                            'data' => [
                                                'static' => [
                                                    'size' => 'xs',
                                                    'color' => 'primary',
                                                    'text' => 'Vars',
                                                ],
                                                'fromParent' => [
                                                    'id' => 'target'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'table-tr-collapse' => [
                                    'template' => 't4web-admin/block/table-tr-collapse',
                                    'capture' => 'table-tr-collapse',
                                    'data' => [
                                        'fromParent' => [
                                            'id' => 'target',
                                            'calculatedVars' => 'value',
                                        ],
                                        'static' => [
                                            'jsonPrettyPrint' => true,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'childrenDynamicLists' => [
                        'table-body-row' => 'rowsData',
                    ],
                ],
                'paginator' => [
                    'extend' => 't4web-admin-paginator',
                    'viewModel' => 'Mail\MailLogEntry\ViewModel\PaginatorViewModel',
                    'data' => [
                        'static' => [
                        ],
                        'fromGlobal' => [
                            'validCriteria' => 'validCriteria',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'blocks' => [
        't4web-admin-sidebar-menu' => [
            'children' => [
                [
                    'extend' => 't4web-admin-sidebar-menu-item',
                    'capture' => 'item',
                    'data' => [
                        'static' => [
                            'label' => 'Mail',
                            'route' => 'admin-MailLogEntry-list',
                            'icon' => 'fa-envelope',
                        ],
                    ],
                ],
            ],
        ],
    ],
];

