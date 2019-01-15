<?php

namespace Application\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

use Application\MenuBundle\Entity\Menu;
use Application\MenuBundle\Entity\MenuItems;
use Application\PageBundle\Entity\Page;

use Application\MenuBundle\Form\Type\MenuType;

class MenuController extends Controller
{
    public function menuAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locales = $manager->getRepository("ApplicationBoardBundle:Locale")->findBy(array("isActive" => true), array("sortorder" => "ASC"));
        
        $form = $this->createFormBuilder()->add('action','hidden',array('attr' => array('value' => 'save')))->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            switch($form['action']->getData())
            {
                case 'save':
                    
                    if($request->request->get('sortorder'))
                    {
                        foreach($request->request->get('sortorder') as $key => $value)
                        {
                            $item = $manager->getRepository("ApplicationMenuBundle:Menu")->find($key);
                            $item->setSort($value);
                            $manager->persist($item);
                        }

                        $manager->flush();
                    }
                    
                    $this->addFlash(
                            'notice',
                            $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Успешно!</strong> Изменения сохранены.</div>')
                    );
                    
                break;
                
                case 'delete':
                    
                    if($request->request->get('menuIds'))
                    {
                        foreach($request->request->get('menuIds') as $menuId)
                        {
                            $menu = $manager->getRepository("ApplicationMenuBundle:Menu")->find($menuId);

                            foreach ($menu->getItems() as $item) {
                                $manager->remove($item);
                            }

                            $manager->remove($menu);

                            $manager->flush();
                        }
                    }
                    
                    $this->addFlash(
                            'notice',
                            $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Успешно!</strong> Записи удалены.</div>')
                    );
                break;
            }
            
            return $this->redirectToRoute("application_menu_board_index");
        }
        
        return $this->render('ApplicationMenuBundle:Board:menu.html.twig',array("locales" => $locales, "form" => $form->createView()));
    }
    
    public function editAction($menuId, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $subtitle = "Add";
        $originalItems = new ArrayCollection();
        
        $pages = $this->getDoctrine()->getRepository('ApplicationBoardBundle:Page')->findAll();
        
        if($menuId)
        {
            $menu = $manager->getRepository("ApplicationMenuBundle:Menu")->find($menuId);
            
            foreach ($menu->getItems() as $item) {
                $originalItems->add($item);
            }
            
            $subtitle = "Edit";
        }
        
        $menuForm = $this->createForm(new MenuType($manager),$menu);
        
        $menuForm->handleRequest($request);
        
        if($menuForm->isValid())
        {
            if($originalItems)
            {
                foreach ($originalItems as $item) 
                {
                    if (false === $menu->getItems()->contains($item)) 
                    {
                        $item->setMenu(null);
                        $manager->remove($item);
                    }
                }
            }
            
            if(!$menuId)
            {
                $menuCount = $manager->getRepository("ApplicationMenuBundle:Menu")->menuCount();
                $menu->setSort($menuCount + 1);
            }
            
            $manager->persist($menu);
            
            if($menu->getItems())
            {
                foreach($menu->getItems() as $item)
                {
                    $item->setMenu($menu);
                    $manager->persist($item);
                }
            }

            $manager->flush();
                       
            $this->addFlash(
                        'notice_success',
                        $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Успешно!</strong> Информация сохранена.</div>')
                    ); 
            
            if($menuForm['exit']->getData())
            {
                return $this->redirectToRoute("application_menu_board_index");
            }
            
            return $this->redirect($this->generateUrl('application_menu_board_edit', array('menuId' => $menu->getId())));
        }
        return $this->render("ApplicationMenuBundle:Board:edit.html.twig", array("subtitle" => $subtitle, "menuForm" => $menuForm->createView(), "pages" => $pages));
    }
}
