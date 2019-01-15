<?php
namespace Application\BlogBundle\Form\Type;
    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Doctrine\Common\Persistence\ObjectManager;

class BlogType extends AbstractType
{   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', HiddenType::class, array('required' => false))
            ->add('imageNew', FileType::class, array('required' => false, 'label' => 'Изображение:', 'mapped' => false, 'attr' => array('class' => 'form-control')))
            ->add('backgroundImage', HiddenType::class, array('required' => false))
            ->add('backgroundImageNew', FileType::class, array('required' => false, 'label' => 'Фоновое изображение:', 'mapped' => false, 'attr' => array('class' => 'form-control')))
            ->add('title', TextType::class, array('required' => true, 'label' => 'Заголовок:', 'attr' => array('class' => 'form-control')))
            ->add('translit', TextType::class, array('required' => true, 'label' => 'Транслит:', 'attr' => array('class' => 'form-control')))
            ->add('tieser', TextareaType::class, array('required' => false, 'label' => 'Краткое описание:', 'attr' => array('class' => 'form-control')))
            ->add('sortorder', TextType::class, array('required' => true, 'label' => 'Порядок:', 'attr' => array('class' => 'form-control')))
            ->add('text', TextareaType::class, array('required' => false, 'label' => 'Подробный текст:', 'attr' => array('class' => 'form-control tinyeditor')))
            ->add('type', ChoiceType::class,array('choices' => array('1' => 'Новости','2' => 'Акции'),'required' => true, 'label' => 'Тип:', 'attr' => array('class' => 'form-control')))
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
            'data_class' => 'Application\BlogBundle\Entity\Blog',
            'translation_domain' => 'messages'
        ));
    }
    
    public function getName()
    {
        return 'blog';
    }
}

