<?php

namespace Application\BoardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function getHeaderAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $manager = $this->getDoctrine()->getManager();
        $messages = $manager->getRepository("ApplicationBoardBundle:Message")->findBy(array("isNew" => true));
        
        return $this->render('ApplicationBoardBundle:Common:header.html.twig', array('user' => $user, 'messages' => $messages));
    }
    public function getFooterAction()
    {
        return $this->render('ApplicationBoardBundle:Common:footer.html.twig');
    }
    public function getSidebarAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $messages = $manager->getRepository("ApplicationBoardBundle:Message")->findBy(array("isNew" => true));
        
        return $this->render('ApplicationBoardBundle:Common:sidebar.html.twig', array('messages' => $messages));
    }
    
    /**
     * @Route("/board", name="indexBoard")
     */
    public function indexAction(Request $request)
    {
        return $this->render('@board/index.html.twig');
    }
    
    /**
     * @Route("/board/clearcache", name="boardClearCache")
     */
    public function clearCacheAction()
    {
        $kernel = $this->get('kernel');
        $application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        $application->setAutoExit(false);
        $options = array('command' => 'cache:clear',"--env" => 'prod', '--no-warmup' => true);
        $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
        
        return $this->redirectToRoute("indexBoard");
    }

}
