<?php

namespace Application\PortfolioBundle\Form\Type;
    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Application\PortfolioBundle\Form\DataTransformer\PortfolioToNumberTransformer;
use Doctrine\Common\Persistence\ObjectManager;

class PortfolioImageType extends AbstractType
{    
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('imageNew', 'file', array('required' => false, 'label' => 'Image','mapped' => false, 'attr' => array('class' => 'form-control m-t-15')))
            ->add('image', 'hidden', array('required' => true, 'label' => ''))
            ->add('alt', 'text', array('required' => false, 'label' => 'Alt', 'attr' => array('class' => 'form-control','placeholder' => 'Alt')))
            ->add('title', 'text', array('required' => false, 'label' => 'Title', 'attr' => array('class' => 'form-control', 'placeholder' => 'Title')))
            ->add('sortorder', 'text', array('required' => true, 'label' => 'Порядок', 'attr' => array('class' => 'item-sortorder')))
            ->add('style', 'text', array('required' => false, 'label' => 'Стиль расположения на странице:', 'attr' => array('class' => 'form-control')))
            ->add($builder->create('portfolioItem', 'hidden')->addModelTransformer(new PortfolioToNumberTransformer($this->manager)));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\PortfolioBundle\Entity\PortfolioImage',
            'translation_domain' => 'messages'
        ));
    }
    
    public function getName()
    {
        return 'portfolioImage';
    }
    
}


