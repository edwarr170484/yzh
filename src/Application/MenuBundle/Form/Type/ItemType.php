<?php

namespace Application\MenuBundle\Form\Type;
    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Application\MenuBundle\Form\DataTransformer\PageToNumberTransformer;
use Application\MenuBundle\Form\DataTransformer\MenuToNumberTransformer;
use Application\MenuBundle\Form\DataTransformer\MenuItemsToNumberTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

class ItemType extends AbstractType
{    
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('title', 'text', array('required' => true, 'label' => 'Название пункта меню', 'attr' => array('class' => 'form-control')))
            ->add('link', 'text', array('required' => false, 'label' => 'Ссылка', 'attr' => array('class' => 'form-control')))
            //->add($builder->create('parent', 'hidden')->addModelTransformer(new MenuItemsToNumberTransformer($this->manager)))
            ->add('parentId', 'hidden', array('required' => false))
            ->add('page', 'entity', array('class' => 'ApplicationBoardBundle:Page',
                            'choice_label' => 'pageName',
                            'empty_data' => null,
                            'required' => false,
                            'group_by' => 'locale.name',
                            'label' => 'Страница', 'attr' => array('class' => 'hidden-input form-control','id' => 'region','placeholder' => 'Страница')))
            ->add('block', 'choice', array('required' => false,'choices' => array('1'   => 'Программы ДМС','2' => 'Полезная информация','3'   => 'Законодательство'), 'label' => 'Секция меню', 'attr' => array('class' => 'form-control')))
            ->add($builder->create('menu', 'hidden')->addModelTransformer(new MenuToNumberTransformer($this->manager)))    
            ->add('sort', 'text', array('required' => false, 'label' => 'Порядок', 'attr' => array('class' => 'item-sortorder')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\MenuBundle\Entity\MenuItems',
            'translation_domain' => 'messages'
        ));
    }
    
    public function getName()
    {
        return 'item';
    }
    
}


