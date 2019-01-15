<?php

namespace Application\BoardBundle\Form\Type;
    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Application\BoardBundle\Form\DataTransformer\PageToNumberTransformer;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PageblockType extends AbstractType
{    
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('blockContent', TextareaType::class, array('required' => false, 'label' => 'Содержимое блока', 'attr' => array('class' => 'form-control tinyeditor')))
            ->add('sortorder', TextType::class, array('required' => true, 'label' => 'Order', 'attr' => array('class' => 'item-sortorder')))
            ->add($builder->create('page', HiddenType::class)->addModelTransformer(new PageToNumberTransformer($this->manager)));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\BoardBundle\Entity\PageBlock'
        ));
    }
    
    public function getName()
    {
        return 'block';
    }
    
}


