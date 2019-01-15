<?php
namespace Application\PortfolioBundle\Form\Type;
    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PortfolioCategoryType extends AbstractType
{   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('required' => true, 'label' => 'Заголовок:', 'attr' => array('class' => 'form-control')))
            ->add('name', TextType::class, array('required' => true, 'label' => 'Транслит:', 'attr' => array('class' => 'form-control')))
            ->add('sortorder', TextType::class, array('required' => true, 'label' => 'Порядок:', 'attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('required' => false, 'label' => 'Подробный текст:', 'attr' => array('class' => 'form-control tinyeditor')))
            ->add('metaTagTitle', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Title:', 'attr' => array('class' => 'form-control')))
            ->add('metaTagDescription', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Description:', 'attr' => array('class' => 'form-control')))
            ->add('metaTagKeywords', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Keywords:', 'attr' => array('class' => 'form-control')))
            ->add('metaTagRobots', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Robots:', 'attr' => array('class' => 'form-control')))
            ->add('metaTagAuthor', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Author:', 'attr' => array('class' => 'form-control')))
            ->add('locale', 'entity', array('class' => 'ApplicationBoardBundle:Locale',
                            'choice_label' => 'name',
                            'empty_data' => null,
                            'required' => true, 
                            'query_builder' => function(EntityRepository $er){return $er->createQueryBuilder('l')->orderBy('l.sortorder', 'ASC');},
                            'label' => 'Локализация:', 'attr' => array('class' => 'hidden-input form-control','id' => 'region','placeholder' => 'Локализация:')))
            ->add('exit', HiddenType::class, array('required' => false, 'data' => '0', 'mapped' => false));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\PortfolioBundle\Entity\PortfolioCategory',
        ));
    }
    
    public function getName()
    {
        return 'portfolioCategory';
    }
}

