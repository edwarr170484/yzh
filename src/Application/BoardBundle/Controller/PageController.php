<?php

namespace Application\BoardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Application\BoardBundle\Entity\Page;
use Application\BoardBundle\Entity\PageBlock;
use Application\BoardBundle\Form\Type\PageblockType;

class PageController extends Controller
{
    /**
     * @Route("/board/page", name="pageBoard")
     */
    public function pageAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locales = $manager->getRepository("ApplicationBoardBundle:Locale")->findBy(array("isActive" => true), array("sortorder" => "ASC"));
        $fm = new Filesystem();
        
        $form = $this->createFormBuilder()->add('action','hidden',array('attr' => array('value' => 'save')))->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            switch($form['action']->getData())
            {
                case 'delete':
                    if($request->request->get('pageIds'))
                    {
                        foreach($request->request->get('pageIds') as $pageId)
                        {
                            $page = $manager->getRepository("ApplicationBoardBundle:Page")->find($pageId);
                            
                            if($page)
                            {
                                if($page->getBlocks())
                                {
                                    foreach($page->getBlocks() as $block)
                                    {
                                        $block->setPage(null);
                                        $manager->remove($block);
                                    }
                                    
                                    $manager->flush();
                                }

                                $manager->remove($page);
                            }
                        }
                        
                        $manager->flush();
                        
                        $this->addFlash(
                            'notice',
                            $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Успешно!</strong> Записи удалены.</div>')
                        );
                    }
                break;
            }
            
            return $this->redirectToRoute("pageBoard");
        }
        
        return $this->render('@board/Page/page.html.twig', array("locales" => $locales, "form" => $form->createView()));
    }
    
    /**
     * @Route("/board/edit/page/{pageId}", name="pageBoardEdit", defaults={"pageId" : "0"})
     */
    public function pageEditAction($pageId, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $originalBlocks = new ArrayCollection();
        $locales = $manager->getRepository("ApplicationBoardBundle:Locale")->findBy(array(), array("sortorder" => "ASC"));
        $fm = new Filesystem();
        
        $page = ($pageId) ? $manager->getRepository("ApplicationBoardBundle:Page")->find($pageId) : new Page();
        
        if($pageId && $page)
        {
            foreach ($page->getBlocks() as $block) {
                $originalBlocks->add($block);
            }
        }
        
        $pageForm = $this->get('form.factory')->createNamedBuilder('page', 'form', $page)
                ->add('pageName', TextType::class, array('required' => true, 'label' => 'Название страницы:', 'attr' => array('class' => 'form-control')))
                ->add('pageRoute', TextType::class, array('required' => true, 'label' => 'URI (Начинается с "/" ):', 'attr' => array('class' => 'form-control')))
                ->add('pageContent', TextareaType::class, array('required' => false, 'label' => 'Содержимое страницы:', 'attr' => array('class' => 'form-control tinyeditor')))
                ->add('metaTagTitle', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Title:', 'attr' => array('class' => 'form-control')))
                ->add('metaTagDescription', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Description:', 'attr' => array('class' => 'form-control')))
                ->add('metaTagKeywords', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Keywords:', 'attr' => array('class' => 'form-control')))
                ->add('metaTagRobots', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Robots:', 'attr' => array('class' => 'form-control')))
                ->add('metaTagAuthor', TextareaType::class, array('required' => false, 'label' => 'Мета-тег Author:', 'attr' => array('class' => 'form-control')))
                ->add('blocks', 'collection', array('type' => new PageblockType($manager), 'label' => ' ','allow_add'    => true, 'allow_delete' => true, 'by_reference' => false,
                                               'attr' => array('class' => 'page_blocks')))
                ->add('locale', 'entity', array('class' => 'ApplicationBoardBundle:Locale',
                            'choice_label' => 'name',
                            'empty_data' => null,
                            'required' => true, 
                            'query_builder' => function(EntityRepository $er){return $er->createQueryBuilder('l')->orderBy('l.sortorder', 'ASC');},
                            'label' => 'Локализация:', 'attr' => array('class' => 'hidden-input form-control','id' => 'region','placeholder' => 'Локализация:')))
                ->add('exit', HiddenType::class, array('required' => false, 'mapped' => false))->getForm();
        
        $pageForm->handleRequest($request);
        
        if($pageForm->isValid())
        {
            if($originalBlocks)
            {
                foreach ($originalBlocks as $block) 
                {
                    if (false === $page->getBlocks()->contains($block)) 
                    {
                        $block->setPage(null);
                        $manager->remove($block);
                    }
                }
            }  
            
            if($page->getBlocks())
            {
                foreach($page->getBlocks() as $block)
                {
                    $block->setPage($page);
                    $manager->persist($block);
                }
            }
            
            $manager->persist($page);
            $manager->flush();
            
            $this->addFlash(
                'notice',
                $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Успешно!</strong> Страница сохранена.</div>')
            );
            
             if($pageForm['exit']->getData())
            {
                return $this->redirectToRoute("pageBoard");
            }
                        
            return $this->redirectToRoute('pageBoardEdit', array("pageId" => $page->getId()));
        }
        return $this->render('@board/Page/edit.html.twig', array("page" => $page,"pageForm" => $pageForm->createView()));
    }
}

