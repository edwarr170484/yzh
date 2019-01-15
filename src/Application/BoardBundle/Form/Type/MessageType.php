<?php

namespace Application\BoardBundle\Form\Type;
    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Application\BoardBundle\Form\DataTransformer\PageToNumberTransformer;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    private $formName;
    
    public function __construct($formName) {
        $this->formName = $formName;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('name', TextType::class, array('required' => true, 'label' => 'Ваше имя','attr' => array('class' => 'form-control','placeholder' => 'Ваше имя')))
            ->add('email', TextType::class, array('required' => false, 'label' => 'Ваша эл. почта', 'attr' => array('class' => 'form-control','placeholder' => 'Ваша эл. почта')))
            ->add('phone', TextType::class, array('required' => true, 'label' => 'Ваш телефон', 'attr' => array('class' => 'form-control','placeholder' => 'Ваш телефон')))
            ->add('message', TextareaType::class, array('required' => true, 'label' => 'Сообщение', 'attr' => array('class' => 'form-control','placeholder' => 'Сообщение')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\BoardBundle\Entity\Message',
            'translation_domain' => 'messages'
        ));
    }
    
    public function getName()
    {
        return $this->formName;
    }
    
    
}