<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('email', null, array('attr'=>array('placeholder'=>'Enter Email')))
		->add('username', null, array('attr'=>array('placeholder'=>'Enter Username')))
		->add('submit', 'submit');
	}

	public function getName()
	{
		return 'person';
	}
}