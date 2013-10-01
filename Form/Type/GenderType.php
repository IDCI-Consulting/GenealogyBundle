<?php

namespace IDCI\Bundle\GenealogyBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenderType extends AbstractType
{
    protected $genders;
    
    public function __construct($genders)
    {
        $this->genders = $genders;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->genders
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return "gender";
    }
}