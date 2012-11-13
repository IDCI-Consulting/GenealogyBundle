<?php

namespace IDCI\Bundle\GenealogyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('elements')
            ->add('updated_at', 'datetime', array(
               'data' => new \DateTime('now'),
               'attr' => array('style'=>'display:none;')
           ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\GenealogyBundle\Entity\Media'
        ));
    }

    public function getName()
    {
        return 'idci_bundle_genealogybundle_mediatype';
    }
}