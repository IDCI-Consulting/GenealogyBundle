<?php

namespace IDCI\Bundle\GenealogyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ElementType extends AbstractType
{
    private $elementClass;

    /**
     * Constructor
     *
     * @param type $elementClass the element entity class
     */
    public function __construct($elementClass)
    {
        $this->elementClass = $elementClass;
    }

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
                'class' => $this->elementClass,
                'required' => false,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder("e")
                        ->where("e.sex = :sex")
                        ->setParameter("sex", "m")
                    ;
                },
            ))
            ->add('mother', 'entity', array(
                'class' => $this->elementClass,
                'required' => false,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder("e")
                        ->where("e.sex = :sex")
                        ->setParameter("sex", "f")
                    ;
                },
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
        return 'idci_bundle_genealogybundle_element';
    }
}
