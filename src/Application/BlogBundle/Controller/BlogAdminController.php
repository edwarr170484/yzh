<?php
namespace Application\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Doctrine\Common\Collections\ArrayCollection;


use Application\BlogBundle\Entity\Blog;
use Application\BlogBundle\Form\Type\BlogType;

class BlogAdminController extends Controller
{
    public function blogAction($page, Request $request)
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
                case 'save':
                    
                    //change active state of all blog items for all locations
                    $items = $manager->getRepository("ApplicationBlogBundle:Blog")->findAll();
                    foreach($items as $item)
                    {
                        $item->setIsActive(false);
                        $manager->persist($item);
                    }
                    
                    $manager->flush();
                    
                    if($request->request->get('blogActive'))
                    {
                        foreach($request->request->get('blogActive') as $key => $value)
                        {
                            $item = $manager->getRepository("ApplicationBlogBundle:Blog")->find($key);
                            $item->setIsActive(true);
                            $manager->persist($item);
                        }

                        $manager->flush();
                    }
                    
                    if($request->request->get('sortorder'))
                    {
                        foreach($request->request->get('sortorder') as $key => $value)
                        {
                            $item = $manager->getRepository("ApplicationBlogBundle:Blog")->find($key);
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
                    if($request->request->get('blogIds'))
                    {
                        foreach($request->request->get('blogIds') as $blogId)
                        {
                            $item = $manager->getRepository("ApplicationBlogBundle:Blog")->find($blogId);
                            
                            if($item)
                            {
                                if($item->getImage())
                                {
                                    if($fm->exists($request->server->get('DOCUMENT_ROOT') . '/bundles/images/blog/' . $item->getImage()))
                                    {
                                        $fm->remove($request->server->get('DOCUMENT_ROOT') . '/bundles/images/blog/' . $item->getImage());
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
            
            return $this->redirectToRoute("blogBoard");
        }

        return $this->render('ApplicationBlogBundle:BlogBoard:blog.html.twig', array("locales" => $locales, "form" => $form->createView()));
    }

    public function blogEditAction($itemId, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $fm = new Filesystem();
        
        $item = ($itemId) ? $manager->getRepository("ApplicationBlogBundle:Blog")->find($itemId) : new Blog();
        
        $itemForm = $this->createForm(new BlogType(), $item);
        
        $itemForm->handleRequest($request);
        
        if($itemForm->isSubmitted() && $itemForm->isValid())
        {
            $simpleImage = $this->get('app.simpleimage');
            
            $image = $itemForm['imageNew']->getData();
            $oldImage = $itemForm['image']->getData();
                    
            if($image)
            {
                if($oldImage)
                {
                    if($fm->exists($request->server->get('DOCUMENT_ROOT') . '/bundles/images/blog/' . $oldImage ))
                    {
                        $fm->remove($request->server->get('DOCUMENT_ROOT') . '/bundles/images/blog/' . $oldImage );
                    }
                }
                    
                $extention = $image->getClientOriginalExtension();
                $localImageName = rand(1, 99999).'.'.$extention;
                $image->move('bundles/images/blog',$localImageName);
                $item->setImage($localImageName);
            }
            
            $item->setDate(new \DateTime());
            $item->setIsActive(true);
            
            if(!$itemId)
            {
                $items = $manager->getRepository("ApplicationBlogBundle:Blog")->findAll();
                $item->setSortorder(count($items) + 1);
            }
            
            $backgroundImage = $itemForm['backgroundImageNew']->getData();
            $oldbackgroundImage = $itemForm['backgroundImage']->getData();

            if($backgroundImage)
            {
                if($oldbackgroundImage)
                {
                    if($fm->exists($request->server->get('DOCUMENT_ROOT') . '/bundles/images/backgrounds/' . $oldbackgroundImage ))
                    {
                        $fm->remove($request->server->get('DOCUMENT_ROOT') . '/bundles/images/backgrounds/' . $oldbackgroundImage );
                    }
                }

                $extention = $backgroundImage->getClientOriginalExtension();
                $localImageName = rand(1, 99999).'.'.$extention;
                $backgroundImage->move('bundles/images/backgrounds',$localImageName);
                $item->setBackgroundImage($localImageName);
            }    
            
            $manager->persist($item);
            $manager->flush();
            
            $this->addFlash(
                'notice',
                $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Выполнено!</strong> Изменения сохранены.</div>')
            );
            
            if($itemForm['exit']->getData())
            {
                return $this->redirectToRoute("blogBoard");
            }
            
            return $this->redirectToRoute("blogEditBoard", array("itemId" => $item->getId()));
        }
        
        return $this->render('ApplicationBlogBundle:BlogBoard:single.html.twig', array("itemId" => $itemId, "itemForm" => $itemForm->createView()));
    }
}

