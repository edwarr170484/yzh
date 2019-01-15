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

class FrontController extends Controller
{
    public function portfolioAction($pageNumber, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/portfolio", "locale" => $locale));
        
        if(!$page)
        {
            throw $this->createNotFoundException();
        }
        
        $porfolios = $manager->getRepository("ApplicationPortfolioBundle:PortfolioItem")->findBy(array(), array("sortorder" => "ASC"));
        
        return $this->render('ApplicationPortfolioBundle:Front:portfolio.html.twig', array("page" => $page, "locale" => $locale,"porfolios" => $porfolios));
    }
    
    public function singleAction($portfolioName, $pageNumber, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        
        $porfolio = $manager->getRepository("ApplicationPortfolioBundle:PortfolioItem")->findOneBy(array("name" => $portfolioName));
        
        if(!$porfolio)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('ApplicationPortfolioBundle:Front:single.html.twig', array("porfolio" => $porfolio,"locale" => $locale));
    }
}

