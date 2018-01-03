<?php

namespace Customer\Controller;

error_reporting(E_ALL);
//error_reporting(E_DEPRECATED);
use Customer\Form\Add;
use Customer\Inputfilter\AddCustomer;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Customer\Model\Customertable;
use Zend\View\Model\JsonModel;  /// Ajax
use Customer\util\Utilities; /// Dont remove it, this a custom class.

class CustomerController extends AbstractActionController
{

	protected $customerTable;


    public function indexAction()
    {
        $customerModuleNavigation =array(
            array("label"=>"Add Customer","href"=>"customer/add")

        );
       return new ViewModel(array('result' => $this->getCustomerTable()->getALLCustomers(),
         ));
    }



    public function customerDetailAction()
    {
    	
    	/// echo $this->getRequest()->getQuery('id');  /// To get Query Stings.
    	///$id = $this->params()->fromRout('id');
    	//print_r();exit;
    	$id=$this->params('id');
    	
    	//$account_no="anwaar";
       return new ViewModel(
       		array(
       				'result' => $this->getCustomerTable()->selectRowByid(array("id"=>$id))
       			)
         );
    }


    
    public function addAction()
    {
    	$form=new Add();
    	///$customerTable = new"Customertable");

    	$message = "";

    	

    	$request = $this->getRequest();
        if ($request->isXmlHttpRequest())
        {
        	/*
        	$out = array("ajaxMessageCode"=>"404","msg"=>"Account Already Exist!");        	
    		$response = $this->getResponse();
		    $response->setStatusCode(200);
		    $response->setContent(json_encode($out));
		    $headers = $response->getHeaders();
		    $headers->addHeaderLine('Content-Type', 'application/json');
		    return $response;
		    */		   
		    $account_no = $_POST['name'];
		    $returnArray = '';
		    if($this->getCustomerTable()->selectRowByid(array("customer_account_number"=>$account_no)))
    			{    				
    				$returnArray = array("ajaxMessageCode"=>"1");
    			}
    			else
    			{
    				$returnArray = array("ajaxMessageCode"=>"0");
    			}
			$result = new JsonModel($returnArray);
			$result->setTerminal(true);
			return $result;
        }



    	if($this->request->isPost())
    	{
    		///$form->setValidationGroup('name', 'accountno');

    		$form->setInputFilter(new AddCustomer());
    		$form->setData($this->request->getPost());
    		if($form->isValid())
    		{
    			$formData = $form->getData();
    			/// First check account already exist or not
    			
	    			if($this->getCustomerTable()->selectRowByid(array("customer_account_number"=>$formData["accountno"])))
	    			{
	    				$message = "Account Number Already Exist";
	    				return new ViewModel(array("form"=>$form,"message"=>$message));
	    			}    		    		

	    			$data_to_insert = 								array();
	    			$data_to_insert["customer_name"]=				$formData["name"];
	    			$data_to_insert["customer_account_number"]=		$formData["accountno"];
	    			$data_to_insert["contact_person_name"]=			$formData["accountperson"];
	    			$data_to_insert["vat_applied"]=					$formData["isvat"];
	    			$data_to_insert["customer_phone_primary"]=		$formData["primaryphonenumber"];
	    			$data_to_insert["customer_phone_alternate"]=	$formData["alternatephonenumber"];
	    			$data_to_insert["customer_fax"]=				$formData["fax"];
	    			$data_to_insert["customer_email"]=				$formData["email"];
	    			$data_to_insert["customer_additional_info"]=	$formData["customerinformation"];
	    			$data_to_insert["customer_delivery_address1"]=	$formData["deliveryaddressline1"];
	    			$data_to_insert["customer_delivery_address2"]=	$formData["deliveryaddressline2"];
	    			$data_to_insert["customer_delivery_postcode"]=	$formData["deliverypostcode"];
	    			$data_to_insert["customer_invoice_address1"]=	$formData["invoiceaddressline1"];
	    			$data_to_insert["customer_invoice_address2"]=	$formData["invoiceaddressline2"];
	    			$data_to_insert["customer_invoice_postcode"]=	$formData["invoicepostcode"];
	    			$data_to_insert["customer_payment_term"]=		$formData["customerpaymentterm"];
	    			$data_to_insert["customer_group"]=				$formData["customergroup"];
	    			$data_to_insert["customer_notes"]=				$formData["customernotes"];
	    			$data_to_insert["customer_status"]=				$formData["customerstatus"];
					$data_to_insert["updated_date"] = 				date("Y-m-d h:i:s");
					///print_r($data_to_insert);exit;
					try
					{
						if($this->params('id'))
						{
							//print_r($data_to_insert);exit;
							$this->getCustomerTable()->update($data_to_insert,array("id"=>$id));
						}
						else
						{
							$this->getCustomerTable()->addCustomer($data_to_insert);	
						}
						
	    			}catch(Exception $e)
	    			{
	    				echo $e->getMessage();
	    			}
    		}

    	}

    	return new ViewModel(array("form"=>$form,"message"=>$message));
    }


    public function updatecustomerAction()
    {
    	$form=new Add();
    	$id='';
    	$message="";

    	if($this->params('id'))
    	{
    		$id=$this->params('id');  /// exit;
    	}	

    	if($this->request->isPost())
    	{
    		///$form->setValidationGroup('name', 'accountno');

    		$form->setInputFilter(new AddCustomer());
    		$form->setData($this->request->getPost());
    		if($form->isValid())
    		{ 
    			$formData = $form->getData();
    			/// First check account already exist or not    			    			
	    			$data_to_insert = 								array();
	    			$data_to_insert["customer_name"]=				$formData["name"];
	    			$data_to_insert["customer_account_number"]=		$formData["accountno"];
	    			$data_to_insert["contact_person_name"]=			$formData["accountperson"];
	    			$data_to_insert["vat_applied"]=					$formData["isvat"];
	    			$data_to_insert["customer_phone_primary"]=		$formData["primaryphonenumber"];
	    			$data_to_insert["customer_phone_alternate"]=	$formData["alternatephonenumber"];
	    			$data_to_insert["customer_fax"]=				$formData["fax"];
	    			$data_to_insert["customer_email"]=				$formData["email"];
	    			$data_to_insert["customer_additional_info"]=	$formData["customerinformation"];
	    			$data_to_insert["customer_delivery_address1"]=	$formData["deliveryaddressline1"];
	    			$data_to_insert["customer_delivery_address2"]=	$formData["deliveryaddressline2"];
	    			$data_to_insert["customer_delivery_postcode"]=	$formData["deliverypostcode"];
	    			$data_to_insert["customer_invoice_address1"]=	$formData["invoiceaddressline1"];
	    			$data_to_insert["customer_invoice_address2"]=	$formData["invoiceaddressline2"];
	    			$data_to_insert["customer_invoice_postcode"]=	$formData["invoicepostcode"];
	    			$data_to_insert["customer_payment_term"]=		$formData["customerpaymentterm"];
	    			$data_to_insert["customer_group"]=				$formData["customergroup"];
	    			$data_to_insert["customer_notes"]=				$formData["customernotes"];
	    			$data_to_insert["customer_status"]=				$formData["customerstatus"];
					$data_to_insert["updated_date"] = 				date("Y-m-d h:i:s");
					///print_r($data_to_insert);exit;
					try
					{						
						///print_r($data_to_insert);exit;
						$this->getCustomerTable()->update($data_to_insert,array("id"=>$id));
						 $this->flashMessenger()->addMessage('Thank you for your comment!');
						
	    			}
	    			catch(Exception $e)
	    			{
	    				echo $e->getMessage();
	    			}
    		}

    	}else   /// Else
    	{
    		/// $id=$this->params('id');
    		$customerDetail = $this->getCustomerTable()->selectRowByid(array("id"=>$id));
    		$customerDetail = $customerDetail[0];
    		$form->get('name')->setValue($customerDetail["customer_name"]);
    		///$form->get('accountno')->setValue($customerDetail["customer_account_number"]);
    		/// $form->remove("accountno"); 
    		///$form->get('accountno')->setAttribute('readonly', 'readonly');

    		$form->get('accountperson')->setValue($customerDetail["contact_person_name"]);
    		$form->get('isvat')->setValue($customerDetail["vat_applied"]);
    		$form->get('primaryphonenumber')->setValue($customerDetail["customer_phone_primary"]);
    		$form->get('alternatephonenumber')->setValue($customerDetail["customer_phone_alternate"]);
    		$form->get('fax')->setValue($customerDetail["customer_fax"]);
    		$form->get('email')->setValue($customerDetail["customer_email"]);
    		$form->get('customerinformation')->setValue($customerDetail["customer_additional_info"]);
    		$form->get('deliveryaddressline1')->setValue($customerDetail["customer_delivery_address1"]);
    		$form->get('deliveryaddressline2')->setValue($customerDetail["customer_delivery_address2"]);
    		$form->get('deliverypostcode')->setValue($customerDetail["customer_delivery_postcode"]);
			$form->get('invoiceaddressline1')->setValue($customerDetail["customer_invoice_address1"]);
			$form->get('invoiceaddressline2')->setValue($customerDetail["customer_invoice_address2"]);    		
			$form->get('invoicepostcode')->setValue($customerDetail["customer_invoice_postcode"]);
			$form->get('customerpaymentterm')->setValue($customerDetail["customer_payment_term"]);
			$form->get('customergroup')->setValue($customerDetail["customer_group"]);
			$form->get('customernotes')->setValue($customerDetail["customer_notes"]);
			$form->get('customernotes')->setValue($customerDetail["customer_status"]);



			    		
    		//echo "ID : ". $id;exit;
    	}

    	return new ViewModel(array("form"=>$form,"message"=>$message));

    }  //// End customer update

   
    public function getCustomerTable()
    {
    	 if (!$this->customerTable) {
             $sm = $this->getServiceLocator();
             $this->customerTable = $sm->get('Customer\Model\CustomerTable');
         }
         return $this->customerTable;
    }
    


}

