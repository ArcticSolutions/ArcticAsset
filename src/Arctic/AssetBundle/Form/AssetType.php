<?php

namespace Arctic\AssetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
* Asset Form Class
*/
class AssetType extends AbstractType
{
	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Arctic\AssetBundle\Entity\Asset'
		);
	}

	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('serialnumber', 'text')
				->add('productnumber', 'text')
				->add('owner', 'choice')
				->add('type', 'choice');
	}

	public function getName()
	{
		return 'asset';
	}
}