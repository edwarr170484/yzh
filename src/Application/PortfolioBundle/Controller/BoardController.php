<?php

namespace Application\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Doctrine\Common\Collections\ArrayCollection;

use Application\PortfolioBundle\Entity\PortfolioCategory;
use Application\PortfolioBundle\Form\Type\PortfolioCategoryType;
use Application\PortfolioBundle\Entity\PortfolioItem;
use Application\PortfolioBundle\Form\Type\PortfolioItemType;

class BoardController extends Controller
{
    public function categoryListAction(Request $request)
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
                            $item = $manager->getRepository("ApplicationPortfolioBundle:PortfolioCategory")->find($key);
                            $item->setSortorder($value);
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
                    if($request->request->get('categoryIds'))
                    {
                        foreach($request->request->get('categoryIds') as $categoryId)
                        {
                            $item = $manager->getRepository("ApplicationPortfolioBundle:PortfolioCategory")->find($categoryId);
                            
                            if($item)
                            {
                                if($item->getPortfolioItems())
                                {
                                    foreach($item->getPortfolioItems() as $portfolioItem)
                                    {
                                        $portfolioItem->setPortfolioCategory(null);
                                        $manager->persist($portfolioItem);
                                    }
                                }
                                
                                $manager->remove($item);
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
            
            return $this->redirectToRoute("portfolioCategoryBoard");
        }
        
        return $this->render('ApplicationPortfolioBundle:Board:categoryList.html.twig', array("locales" => $locales, "form" => $form->createView()));
    }
    
    public function categoryEditAction($itemId, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        
        $portfolioCategory = $manager->getRepository("ApplicationPortfolioBundle:PortfolioCategory")->find($itemId);
        
        if(!$portfolioCategory && !$itemId)
            $portfolioCategory = new PortfolioCategory();
        else
            throw $this->createNotFoundException();
        
        $categoryForm = $this->createForm(new PortfolioCategoryType(), $portfolioCategory);
        $categoryForm->handleRequest($request);
        
        if($categoryForm->isValid())
        {
            $manager->persist($portfolioCategory);
            $manager->flush();
            
            $this->addFlash(
                'notice',
                $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Выполнено!</strong> Изменения сохранены.</div>')
            );
            
            if($categoryForm['exit']->getData())
            {
                return $this->redirectToRoute("portfolioCategoryBoard");
            }
            
            return $this->redirectToRoute("portfolioCategoryEditBoard", array("itemId" => $portfolioCategory->getId()));
        }
        
        return $this->render('ApplicationPortfolioBundle:Board:categoryEdit.html.twig', array("categoryForm" => $categoryForm->createView()));
    }
    
    public function listAction($page, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locales = $manager->getRepository("ApplicationBoardBundle:Locale")->findBy(array("isActive" => true), array("sortorder" => "ASC"));
        
        $form = $this->createFormBuilder()->add('action','hidden',array('attr' => array('value' => 'save')))->getForm();
        $form->handleRequest($request);
        
        return $this->render('ApplicationPortfolioBundle:Board:list.html.twig', array("locales" => $locales, "form" => $form->createView()));
    }
    
    public function editAction($itemId, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $portfolioItem = $manager->getRepository("ApplicationPortfolioBundle:PortfolioItem")->find($itemId);
        $originalImages = new ArrayCollection();
        $fm = new Filesystem();
        
        if(!$portfolioItem && !$itemId)
            $portfolioItem = new PortfolioItem();
        
        if($portfolioItem->getPortfolioImages())
        {            
            foreach ($portfolioItem->getPortfolioImages() as $item) {
                $originalImages->add($item);
            }
        }
        
        $itemForm = $this->createForm(new PortfolioItemType($manager), $portfolioItem);
        $itemForm->handleRequest($request);
        
        if($itemForm->isValid())
        {
            if($originalImages)
            {
                foreach ($originalImages as $image) 
                {
                    if (false === $portfolioItem->getPortfolioImages()->contains($image)) 
                    {
                        if($fm->exists($request->server->get('DOCUMENT_ROOT') . '/bundles/images/portfolio/' . $image->getImage()))
                        {
                            $fm->remove($request->server->get('DOCUMENT_ROOT') . '/bundles/images/portfolio/' . $image->getImage());
                        }
                        $image->setPortfolioItem(null);
                        $manager->remove($image);
                    }
                }
            }        
            
            if($portfolioItem->getPortfolioImages())
            {
                foreach($portfolioItem->getPortfolioImages() as $key => $item)
                {
                    $item->setPortfolioItem($portfolioItem);
                    
                    $image = $itemForm['portfolioImages'][$key]['imageNew']->getData();
                    $oldImage = $itemForm['portfolioImages'][$key]['image']->getData();
                    
                    if($image)
                    {
                        if($oldImage)
                        {
                            if($fm->exists($request->server->get('DOCUMENT_ROOT') . '/bundles/images/portfolio/' . $oldImage ))
                            {
                                $fm->remove($request->server->get('DOCUMENT_ROOT') . '/bundles/images/portfolio/' . $oldImage );
                            }
                        }
                    
                        $extention = $image->getClientOriginalExtension();
                        $localImageName = rand(1, 99999).'.'.$extention;
                        $image->move('bundles/images/portfolio',$localImageName);
                        $item->setImage($localImageName);
                    }
                    
                    $manager->persist($item);
                }
            }
            
            if(!$itemId)
            {
                $portfolioItemCount = count($manager->getRepository("ApplicationPortfolioBundle:PortfolioItem")->findAll());
                $portfolioItem->setSortorder($portfolioItemCount + 1);
                $portfolioItem->setDateAdded(new \DateTime("now"));
            }
            
            $manager->persist($portfolioItem);
            $manager->flush();
            
            $this->addFlash(
                'notice',
                $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Успешно!</strong> Информация успешно сохранена.</div>')
            );
            
            if($itemForm['exit']->getData())
            {
                return $this->redirectToRoute("portfolioBoard");
            }
            
            return $this->redirect($this->generateUrl('portfolioEditBoard', array('itemId' => $portfolioItem->getId())));
        }
        
        return $this->render('ApplicationPortfolioBundle:Board:edit.html.twig', array("itemForm" => $itemForm->createView()));
    }
}

