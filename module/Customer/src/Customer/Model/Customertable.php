<?php

namespace Customer\Model;


use Zend\Db\TableGateway\TableGateway;

class Customertable 
{

	protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

    public function getALLCustomers()
     {
        //$sqlSelect = $this->tableGateway->getSql()->select();
        $resultSet = $this->tableGateway->select();
        $resultSet = $resultSet->toArray();
        if(count($resultSet) >0)
        {
          return  $resultSet;
        }
        else
        {
            return false;
        }
     }

     public function addCustomer($data_to_insert)
     {        
         $resultSet = $this->tableGateway->insert($data_to_insert);
         return $resultSet;
     }

     public function update($data_to_insert, $array)
     {        
         $resultSet = $this->tableGateway->update($data_to_insert,$array);
         return $resultSet;
     }

     public function selectRowByid($rowname)
     {        
        $resultSet = $this->tableGateway->select($rowname);
        $resultSet = $resultSet->toArray();
        ///print_r($resultSet);exit;
        if(count($resultSet) >0)
        {
          return  $resultSet;
        }
        else
        {
            return false;
        }
        
     }
	



}  /// end of class