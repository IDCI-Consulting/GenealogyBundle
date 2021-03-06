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
        $date = new \DateTime('now');
        $year = intval($date->format('Y'));

        $builder
            ->add('name')
            ->add('isFiled', null, array(
                'label' => 'Is filed',
                'required' => false
            ))
            ->add('description')
            ->add('birthDate', 'date', array(
                'required' => false,
                'years' => range(1990, $year)
            ))
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
            ->add('coatColor')
            ->add('image', null, array(
                'label' => 'Photo principale du cheval'
            ))
            ->add('role', 'entity', array(
                'class'    => 'IDCIGenealogyBundle:Role',
                'required' => true
            ))
            ->add('race', 'entity', array(
                'class'    => 'IDCIGenealogyBundle:Race',
                'required' => true
            ))
            ->add('images', 'entity', array(
                'class'    => 'IDCIGenealogyBundle:Image',
                'multiple' => true
            ))
            ->add('videos', 'entity', array(
                'class'    => 'IDCIGenealogyBundle:Video',
                'multiple' => true,
                'label'    => 'Youtube video links'
            ))
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
