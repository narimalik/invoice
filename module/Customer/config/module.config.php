<?php
return array(

    'controllers' => array(
        'invokables' => array(
            'Customer\Controller\Customer' => 'Customer\Controller\CustomerController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'customer' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/customer[/:action][/:id[/:idp]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Customer\Controller\Customer',
                        'action'     => 'index',
                    ),
                ),

                /*
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
                */



            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'customer' => __DIR__ . '/../view',
        ),

        'strategies' => array(
            'ViewJsonStrategy',
        ),
        
    ),
);