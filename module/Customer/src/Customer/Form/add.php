<?php
/**
* 
*/
namespace Customer\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class Add extends Form
{
	
	function __construct()
	{
		parent::__construct('addcustomer');
		$name= new Element\Text("name");
		$name->setLabel('Name');
		//$name->setAttribute("class","form-control");

		$accountno = new Element\Text("accountno");
		$accountno->setLabel("Account No");
		$accountno->setAttribute("id","accountno");

		$contact_person = new Element\Text("accountperson");
		$contact_person->setLabel("Contact Person");

		$is_vat = new Element\Select("isvat");
		$is_vat->setLabel("Is VAT Applied");
		$is_vat->SetValueOptions(array("1"=>"Yes","0"=>"No"));

		$primary_phone_number = new Element\Text("primaryphonenumber");
		$primary_phone_number->setLabel("Primary Phone Number");

		$alternate_phone_number = new Element\Text("alternatephonenumber");
		$alternate_phone_number->setLabel("Alternate Phone Number");

		$fax = new Element\Text("fax");
		$fax->setLabel("FAX");

		$email = new Element\Text("email");
		$email->setLabel("Email");

		$customer_information = new Element\Textarea("customerinformation");
		$customer_information->setLabel("Customer Information");

		$delivery_address_line1 = new Element\Text("deliveryaddressline1");
		$delivery_address_line1->setLabel("Delivery Address Line1");

		$delivery_address_line2 = new Element\Text("deliveryaddressline2");
		$delivery_address_line2->setLabel("Delivery Address Line2");

		$delivery_postcode = new Element\Text("deliverypostcode");
		$delivery_postcode->setLabel("Delivery Post Code");


		$invoice_address_line1 = new Element\Text("invoiceaddressline1");
		$invoice_address_line1->setLabel("Invoice Address Line1");

		$invoice_address_line2 = new Element\Text("invoiceaddressline2");
		$invoice_address_line2->setLabel("Invoice Address Line2");

		$invoice_postcode = new Element\Text("invoicepostcode");
		$invoice_postcode->setLabel("Invoice Post Code");

		$customer_payment_term = new Element\Select("customerpaymentterm");
		$customer_payment_term->setLabel("Customer Payment Term");
		$customer_payment_term->SetValueOptions(array("30"=>"30 Days","60"=>"60 Days","90"=>"90 Days"));


		$customer_group = new Element\Select("customergroup");
		$customer_group->setLabel("Customer Group");
		$customer_group->SetValueOptions(array("1"=>"Wholesaler","2"=>"Retailer"));


		$customer_notes = new Element\Textarea("customernotes");
		$customer_notes->setLabel("Customer notes");

		$customer_status = new Element\Select("customerstatus");
		$customer_status->setLabel("Customer Status");
		$customer_status->SetValueOptions(array("1"=>"Active","0"=>"Inactive"));
		




		$submit = new Element\Text("submit");
		$submit->SetValue("Add Customer");

		$this->add($name);
		$this->add($accountno);
		$this->add($contact_person);
		$this->add($is_vat);		
		$this->add($primary_phone_number);
		$this->add($alternate_phone_number);
		$this->add($fax);
		$this->add($email);
		$this->add($customer_information);
		$this->add($delivery_address_line1);
		$this->add($delivery_address_line2);
		$this->add($delivery_postcode);
		$this->add($invoice_address_line1);
		$this->add($invoice_address_line2);
		$this->add($invoice_postcode);
		$this->add($customer_payment_term);
		$this->add($customer_group);
		$this->add($customer_notes);
		$this->add($customer_status);

		$this->add($submit);


	}
}
?>