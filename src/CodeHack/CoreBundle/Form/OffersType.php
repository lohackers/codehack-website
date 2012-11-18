<?php

namespace CodeHack\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OffersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('type')
//            ->add('quantity')
            ->add('title', 'choice', array(
                'label' => 'Proponiti come ',
                'choices' => array(
                    "Dottore" => "Dottore",
                    "Infermiere" => "Infermiere",
                    "Spalatori" => "Spalatori",
                    "Aiutanti" => "Aiutanti"
            )))
            ->add('mail', null, array('label' => 'Contatto email '))
//            ->add('emergency')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CodeHack\CoreBundle\Entity\Offers'
        ));
    }

    public function getName()
    {
        return 'codehack_corebundle_offerstype';
    }
}
