<?php
namespace Customer;
use Customer\Model\Customer;
use Customer\Model\CustomerTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


    public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Customer\Model\CustomerTable' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $tableGateway= new TableGateway('wdp_customer', $dbAdapter, null);
                     $table = new CustomerTable($tableGateway);
                     return $table;  
                 },
             ),
         );
     }



}
