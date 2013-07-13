<?php

namespace Arctic\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('status', 'choice', array(
                'choices' => array(1 => 'New', 2 => 'Active', 3 => 'Complete', 4 => 'Closed')
            ))
            ->add('asset', 'text')
            ->add('user', null, array(
                'label' => 'Assigned user'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Arctic\TicketBundle\Entity\Ticket'
        ));
    }

    public function getName()
    {
        return 'arctic_ticketbundle_tickettype';
    }
}
