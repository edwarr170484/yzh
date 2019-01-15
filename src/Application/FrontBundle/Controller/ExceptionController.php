<?php

namespace Application\FrontBundle\Controller;

use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ExceptionController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    public function exceptionAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html', $embedded = false)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/notfound", "locale" => $locale));
        
        return $this->render('ApplicationFrontBundle:Common:notfound.html.twig', array("page" => $page,"locale" => $locale));
    }
}

