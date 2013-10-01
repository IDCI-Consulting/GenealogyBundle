<?php

namespace IDCI\Bundle\GenealogyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ElementType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('birthDate')
            ->add('size')
            ->add('weight')
            ->add('sex', 'gender')
            ->add('rank')
            ->add('coatColor')
            ->add('father', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Element',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder("e")
                        ->where("e.sex = :sex")
                        ->setParameter("sex", "m")
                    ;
                },
            ))
            ->add('mother', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Element',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder("e")
                        ->where("e.sex = :sex")
                        ->setParameter("sex", "f")
                    ;
                },
            ))
            ->add('roles')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\GenealogyBundle\Entity\Element'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'idci_bundle_genealogybundle_element';
    }
}
