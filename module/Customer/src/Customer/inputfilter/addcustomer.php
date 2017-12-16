<?php

/**
* 
*/
namespace Customer\InputFilter;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\ValidatorChain;
use Zend\Validator\stringLength;
use Zend\Validator\EmailAddress;

class AddCustomer extends InputFilter
{
	
	function __construct()
	{
		# code...
		$name = new Input('name');
		$name->setRequired(true);
		$name->setValidatorChain($this->getNameValidatorChain());
		$name->setFilterChain($this->getStringTrimFilterChain());


		$accountno = new Input('accountno');
		$accountno->setRequired(true);
		$accountno->setValidatorChain($this->getNameValidatorChain());
		$accountno->setFilterChain($this->getStringTrimFilterChain());



	//	$email = new Input('email');		
	//	$name->setValidatorChain($this->getEmailValidation());
		




///		


		$this->add($name);
		$this->add($accountno);
		//$this->add($email);

	}

	protected function getStringTrimFilterChain()
	{
		$filterChain = new FilterChain();
		$filterChain->attach(new StringTrim());
		return $filterChain;
	}

	protected function getNameValidatorChain()
	{
		$stringLength = new stringLength();
		//$stringLength->setMin(5);
		$stringLength->setMax(50);

		$validatorChain = new validatorChain();
		$validatorChain->attach($stringLength);

		return $validatorChain;
		
	}

	protected function getEmailValidation()
	{
		///$stringLength = new stringLength();
		//	$stringLength->setMax(50);
		$email_validator = new EmailAddress();

		///$email = new validatorChain();
		$validatorChain = new validatorChain();
		///$validatorChain->attach($stringLength);
		$validatorChain->attach($email_validator);

		return $validatorChain;


	}
}	

?>