<?php
namespace App\Controller\Api\V1;

use Crud\Controller\ControllerTrait;
use App\Controller\Api\V1\AppController;

/**
 * OauthClients Controller
 *
 * @property \OAuthServer\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    use ControllerTrait;

    public $modelClass = 'OAuthServer.Clients';

    /**
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->viewClass = 'CrudView\View\CrudView';
        $tables = [
            'Clients',
            'Scopes'
        ];
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'index' => [
                    'className' => 'Crud.Index',
                    'scaffold' => [
                        'tables' => $tables
                    ]
                ],
                'view' => [
                    'className' => 'Crud.View',
                    'scaffold' => [
                        'tables' => $tables
                    ]
                ],
                'edit' => [
                    'className' => 'Crud.Edit',
                    'scaffold' => [
                        'tables' => $tables,
                        'fields' => [
                            'name',
                            'redirect_uri',
                            'parent_model',
                            'parent_id' => [
                                'label' => 'Parent ID',
                                'type' => 'text'
                            ]
                        ]
                    ]
                ],
                'add' => [
                    'className' => 'Crud.Add',
                    'scaffold' => [
                        'tables' => $tables,
                        'fields' => [
                            'name',
                            'redirect_uri',
                            'parent_model',
                            'parent_id' => [
                                'label' => 'Parent ID',
                                'type' => 'text'
                            ]
                        ]
                    ]
                ],
                'delete' => [
                    'className' => 'Crud.Delete',
                    'scaffold' => [
                        'tables' => $tables
                    ]
                ],
            ],
            'listeners' => [
                'CrudView.View',
                'Crud.RelatedModels',
                'Crud.Redirect',
                'Crud.Api'
            ],
        ]);
    }
}