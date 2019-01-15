<?php

namespace Application\BoardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;


class MessageController extends Controller
{
    /**
     * @Route("/board/message", name="messageBoard")
     */
    public function messageAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $messages = $manager->getRepository("ApplicationBoardBundle:Message")->findBy(array(), array("date" => "DESC"));
        
        $form = $this->createFormBuilder()->add('action','hidden',array('attr' => array('value' => 'save')))->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            switch($form['action']->getData())
            {
                case 'save':
                    if($request->request->get('messageIds'))
                    {
                        foreach($request->request->get('messageIds') as $messageId)
                        {
                            $message = $manager->getRepository("ApplicationBoardBundle:Message")->find($messageId);
                            
                            if($message)
                            {
                                $message->setIsNew(false);
                                $manager->persist($message);
                            }
                        }
                        
                        $manager->flush();
                        
                        $this->addFlash(
                            'notice',
                            $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Успешно!</strong> Информация сохранена.</div>')
                        );
                    }
                break;   
                
                case 'delete':
                    if($request->request->get('messageIds'))
                    {
                        foreach($request->request->get('messageIds') as $messageId)
                        {
                            $message = $manager->getRepository("ApplicationBoardBundle:Message")->find($messageId);
                            
                            if($message)
                            {
                                $manager->remove($message);
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
            
            return $this->redirectToRoute("messageBoard");
        }

        return $this->render('@board/Message/message.html.twig', array("messages" => $messages, "form" => $form->createView()));
    }
}

