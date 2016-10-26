<?php

namespace T4web\Mail;

return [
    'contents' => [
        'admin-log-list' => [
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
                        'filter-message' => [
                            'template' => 't4web-admin/block/form-element-text',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'message_like',
                                    'label' => 'Message',
                                ],
                                'fromParent' => [
                                    'message_like' => 'value'
                                ],
                            ],
                        ],
                        'filter-scope' => [
                            'template' => 't4web-admin/block/form-element-select',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'scope_equalTo',
                                    'label' => 'Scope',
                                    'options' =>  [
                                        '' => "All",
                                        1 => "General",
                                    ],
                                ],
                                'fromParent' => [
                                    'scope_equalTo' => 'value'
                                ],
                            ],
                        ],
                        'filter-priority' => [
                            'template' => 't4web-admin/block/form-element-select',
                            'capture' => 'form-element',
                            'data' => [
                                'static' => [
                                    'name' => 'priority_equalTo',
                                    'label' => 'Priority',
                                    'options' =>  [
                                        '' => 'All',
//                                        Logger::PRIORITY_ERR => 'ERR',
//                                        Logger::PRIORITY_WARN => 'WARN',
//                                        Logger::PRIORITY_INFO => 'INFO',
//                                        Logger::PRIORITY_DEBUG => 'DEBUG',
                                    ],
                                ],
                                'fromParent' => [
                                    'priority_equalTo' => 'value'
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
                                    'routeName' => 'admin-log-list',
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
                                'table-th-message' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Message',
                                            'width' => '60%',
                                        ],
                                    ],
                                ],
                                'table-th-scope' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Scope',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-priority' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Priority',
                                            'width' => '5%',
                                        ],
                                    ],
                                ],
                                'table-th-created-dt' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Created date',
                                            'width' => '15%',
                                        ],
                                    ],
                                ],
                                'table-th-extras' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Extras',
                                            'width' => '5%',
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
                                'table-td-message' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['message' => 'value'],
                                    ],
                                ],
                                'table-td-scope' => [
                                    'template' => 't4web-admin/block/table-td-labeled',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'textValueMap' => [
                                                1 => 'General',
                                            ],
                                        ],
                                        'fromParent' => ['scope' => 'value'],
                                    ],
                                ],
                                'table-td-priority' => [
                                    'template' => 't4web-admin/block/table-td-labeled',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'textValueMap' => [
//                                                Logger::PRIORITY_ERR => 'ERR',
//                                                Logger::PRIORITY_WARN => 'WARN',
//                                                Logger::PRIORITY_INFO => 'INFO',
//                                                Logger::PRIORITY_DEBUG => 'DEBUG',
                                            ],
                                            'colorValueMap' => [
//                                                Logger::PRIORITY_ERR => 'danger',
//                                                Logger::PRIORITY_WARN => 'warning',
//                                                Logger::PRIORITY_INFO => 'info',
//                                                Logger::PRIORITY_DEBUG => 'default',
                                            ],
                                        ],
                                        'fromParent' => ['priority' => 'value'],
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
                                        'collapse-button' => [
                                            'template' => 't4web-admin/block/collapse-button',
                                            'capture' => 'button',
                                            'data' => [
                                                'static' => [
                                                    'size' => 'xs',
                                                    'color' => 'primary',
                                                    'text' => 'Show',
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
                                            'extras' => 'value',
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
                    'viewModel' => 'Log\Log\ViewModel\PaginatorViewModel',
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
                            'route' => 'admin-log-list',
                            'icon' => 'fa-envelope',
                            'priority' => '80'
                        ],
                    ],
                ],
            ],
        ],
    ],
];

