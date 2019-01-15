<?php

namespace Application\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Application\BoardBundle\Entity\Message;
use Application\BoardBundle\Form\Type\MessageType;

class DefaultController extends Controller
{
    public function getHeaderAction(Request $request)
    {
        $isIndex = 0;
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $locales = $manager->getRepository("ApplicationBoardBundle:Locale")->findBy(array(),array("sortorder" => "ASC"));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        
        if($request->attributes->get("_route") == "indexFront" || $request->attributes->get("_route") == "indexFrontLocale")
            $isIndex = 1;
        
        return $this->render('ApplicationFrontBundle:Common:header.html.twig', array("settings" => $settings, "isIndex" => $isIndex, "locales" => $locales,"locale" => $locale));
    }
    
    public function getFooterAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        
        $message = new Message();
        $messageForm = $this->createForm(new MessageType('orderMessage'), $message);
        
        $messageForm->handleRequest($request);
        
        if($messageForm->isValid() && $messageForm->isSubmitted())
        {
            $message->setDate(new \DateTime());
            $message->setIsNew(true);
            $manager->persist($message);
            $manager->flush();
            
            $messageSend = \Swift_Message::newInstance()
                    ->setSubject("Новое сообщение из формы обратной связи сайта " . $settings->getSiteName())
                    ->setFrom($settings->getSettingsEmail())
                    ->setTo($settings->getSettingsEmail())
                    ->setBody(
                        $this->renderView(
                            'Emails/message.html.twig',
                            array("name" => $messageForm['name']->getData(),
                                  "email" => $messageForm['email']->getData(),
                                  "phone" => $messageForm['phone']->getData(),
                                  "message" => $messageForm['message']->getData())
                        ),
                        'text/html'
                );

                $this->get('mailer')->send($messageSend);
                
                $this->addFlash(
                    'front_notice',
                    $this->get('translator')->trans('<div class="modal-header justify-content-center">
                            <h5 class="modal-title" id="exampleModalLabel">Ваша заявка отправлена!</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="font-size:1.4rem;text-align:center;">
                            В ближайшее время с Вам свяжутся.
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" data-dismiss="modal">Закрыть</button>
                        </div>')
                );
        }
        
        return $this->render('ApplicationFrontBundle:Common:footer.html.twig', array("settings" => $settings,"locale" => $locale,"messageForm" => $messageForm->createView()));
    }
    
    public function getMenuAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        
        $menu = $manager->getRepository("ApplicationMenuBundle:Menu")->findOneBy(array("name" => "main_menu", "locale" => $locale));
        
        return $this->render('ApplicationFrontBundle:Common:menu.html.twig', array("locale" => $locale, "menu" => $menu));
    }

    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/", "locale" => $locale));
        
        if(!$page)
        {
            throw $this->createNotFoundException();
        }

        return $this->render('ApplicationFrontBundle:Pages:index.html.twig', array("page" => $page, "locale" => $locale));
    }
    
    public function aboutAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/about", "locale" => $locale));
        
        if(!$page)
        {
            throw $this->createNotFoundException();
        }

        return $this->render('ApplicationFrontBundle:Pages:about.html.twig', array("page" => $page,"locale" => $locale));
    }
    
    public function contactAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $settings = $manager->getRepository("ApplicationBoardBundle:Settings")->findOneBy(array("locale" => $locale));
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/contact", "locale" => $locale));
        
        if(!$page)
        {
            throw $this->createNotFoundException();
        }
        
        $message = new Message();
        $messageForm = $this->createForm(new MessageType('contactMessage'), $message);
        
        $messageForm->handleRequest($request);
        
        if($messageForm->isValid() && $messageForm->isSubmitted())
        {
            $message->setDate(new \DateTime());
            $message->setIsNew(true);
            $manager->persist($message);
            $manager->flush();
            
            $messageSend = \Swift_Message::newInstance()
                    ->setSubject("Новое сообщение из формы обратной связи сайта " . $settings->getSiteName())
                    ->setFrom($settings->getSettingsEmail())
                    ->setTo($settings->getSettingsEmail())
                    ->setBody(
                        $this->renderView(
                            'Emails/message.html.twig',
                            array("name" => $messageForm['name']->getData(),
                                  "email" => $messageForm['email']->getData(),
                                  "phone" => $messageForm['phone']->getData(),
                                  "message" => $messageForm['message']->getData())
                        ),
                        'text/html'
                );

                $this->get('mailer')->send($messageSend);
                
                $this->addFlash(
                    'front_notice',
                    $this->get('translator')->trans('<div class="modal-header justify-content-center">
                            <h5 class="modal-title" id="exampleModalLabel">Ваше сообщение отправлено!</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="font-size:1.4rem;text-align:center;">
                            Администратор рассмотрит его в самое ближайшее время.
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" data-dismiss="modal">Закрыть</button>
                        </div>')
                );
                
                if($locale->getIsDefault())
                    return $this->redirectToRoute("contactFront");
                else
                    return $this->redirectToRoute("contactFrontLocale", array("_locale" => $locale->getCode()));
        }
        
        return $this->render('ApplicationFrontBundle:Pages:contact.html.twig', array("page" => $page, "messageForm" => $messageForm->createView(),"locale" => $locale));
    }
	
    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();

        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

        return $this->redirect($url, 301);
    }
    
    public function pageAction($pageUri, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("code" => $request->getLocale()));
        $page = $manager->getRepository("ApplicationBoardBundle:Page")->findOneBy(array("pageRoute" => "/" . $pageUri, "locale" => $locale));
        
        if(!$page)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('ApplicationFrontBundle:Pages:page.html.twig', array("page" => $page,"locale" => $locale));
    }
}
