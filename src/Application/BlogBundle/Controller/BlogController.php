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

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

use Application\BlogBundle\Entity\Blog;

use Application\BlogBundle\Form\Type\BlogType;

class BlogController extends Controller
{
    public function blogAction($pageNumber, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        $news = $manager->getRepository("ApplicationBlogBundle:Blog")->findBy(array("locale" => $locale), array("sortorder" => "ASC"));
        $total = $manager->getRepository("ApplicationBlogBundle:Blog")->findBy(array("locale" => $locale));
        
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/blog", "locale" => $locale));
        
        if($total)
            $totalNews = count($total);
        else
            $totalNews = 0;
        
        if(!$page)
        {
            throw $this->createNotFoundException();
        }
        
        if($locale->getIsDefault())
            $link = "/blog";
        else
            $link = "/" . $locale->getCode() . "/blog";
        
        $pagination = $this->get("app.helpers")->paginator(($pageNumber > 0) ? (int)$pageNumber : 1, $totalNews, 6, $link, "list-inline linst-unstyled");
        
        return $this->render('ApplicationBlogBundle:Blog:blog.html.twig', array("page" => $page, "news" => $news,"pagination" => $pagination)); 
    }
    
    public function singleAction($newsName, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        
        if($newsName)
        {
            $item = $manager->getRepository("ApplicationBlogBundle:Blog")->findOneBy(array("translit" => $newsName, "isActive" => 1));
            
            if(!$item)
            {
                throw $this->createNotFoundException();
            }
            
            $prev = $manager->createQuery('SELECT b FROM ApplicationBlogBundle:Blog b WHERE b.id = (SELECT MAX(bl.id) FROM ApplicationBlogBundle:Blog bl WHERE bl.id < :id ) AND b.locale = :locale_id')->setParameter(':id',  $item->getId())->setParameter(':locale_id', $locale->getId())->getOneOrNullResult();
            $next = $manager->createQuery('SELECT b FROM ApplicationBlogBundle:Blog b WHERE b.id = (SELECT MIN(bl.id) FROM ApplicationBlogBundle:Blog bl WHERE bl.id > :id ) AND b.locale = :locale_id')->setParameter(':id',  $item->getId())->setParameter(':locale_id', $locale->getId())->getOneOrNullResult();
            
            return $this->render('ApplicationBlogBundle:Blog:single.html.twig', array("item" => $item, "prev" => $prev, "next" => $next,"settings" => $settings)); 
        }
    }
    
}

