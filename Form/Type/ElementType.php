<?php

namespace IDCI\Bundle\GenealogyBundle\Form\Type;

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
            ->add('birthDate', 'date')
            ->add('sex', 'gender')
            ->add('father', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Element',
                'required' => false,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder("e")
                        ->where("e.sex = :sex")
                        ->setParameter("sex", "m")
                    ;
                },
            ))
            ->add('mother', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Element',
                'required' => false,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder("e")
                        ->where("e.sex = :sex")
                        ->setParameter("sex", "f")
                    ;
                },
            ))
            ->add('size')
            ->add('weight')
            ->add('rank')
            ->add('coatColor')
            ->add('roles', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Role',
                'multiple' => true
            ))
            ->add('race', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Race',
                'required' => true
            ))
            ->add('medias', 'entity', array(
                'class' => 'IDCIGenealogyBundle:Media',
                'multiple' => true
            ))
        ;
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\GenealogyBundle\Entity\Element',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'idci_GenealogyBundle_element';
    }
}
