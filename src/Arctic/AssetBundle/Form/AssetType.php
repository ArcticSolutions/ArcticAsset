<?php

namespace Arctic\AssetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AssetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serialnumber')
            ->add('productnumber')
            ->add('tag')
            ->add('owner')
            ->add('type')
            ->add('status', 'choice', array(
                'choices' => array(
                    1 => 'Available',
                    2 => 'In use',
                    3 => 'In for repair',
                    4 => 'Discarded'
                ),
                'required'    => True,
                'empty_value' => 'Choose a status'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Arctic\AssetBundle\Entity\Asset'
        ));
    }

    public function getName()
    {
        return 'arctic_assetbundle_assettype';
    }
}
