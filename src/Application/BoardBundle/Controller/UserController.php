<?php

namespace Application\BoardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Application\BoardBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/board/users", name="boardUser")
     */
    public function userAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $users = $manager->getRepository("ApplicationBoardBundle:User")->findAll();
        $currentUser = $this->get('security.context')->getToken()->getUser();
        
        $form = $this->createFormBuilder()->add('action','hidden',array('attr' => array('value' => 'save')))->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            switch($form['action']->getData())
            {
                    case 'delete':
                        
                        if($request->request->get('userIds'))
                        {
                            foreach($request->request->get('userIds') as $userId)
                            {
                                $user = $manager->getRepository("ApplicationBoardBundle:User")->find($userId);
                                
                                if($user)
                                {
                                    if($user->getId() == $currentUser->getId())
                                    {
                                        $this->addFlash(
                                            'notice',
                                            $this->get('translator')->trans('<div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Ошибка!</strong> Вы не можете удалить аккаунт пока находтесь в нем.</div>')
                                        );
                                        
                                        return $this->redirectToRoute("boardUser");
                                    }
                                    else
                                        $manager->remove($user);
                                }
                            }
                        }

                        $manager->flush();

                        $this->addFlash(
                            'notice',
                            $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Выполнено!</strong> Записи удалены.</div>')
                        );

                    break;   
            }

            return $this->redirectToRoute("boardUser");
        }
        
        return $this->render('@board/User/list.html.twig', array("users" => $users, "form" => $form->createView()));
    }
    
    /**
     * @Route("/board/user/edit/{userId}", name="boardUserEdit", defaults={"userId" : 0})
     */
    public function editUserAction($userId, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository("ApplicationBoardBundle:User")->find($userId);
        
        $user = ($userId) ? $manager->getRepository("ApplicationBoardBundle:User")->find($userId) : new User();
        
        $userForm = $this->get('form.factory')->createNamedBuilder('user', 'form', $user)
            ->add('name', TextType::class, array('required' => false, 'label' => 'Ф.И.О.', 'attr' => array('class' => 'form-control')))   
            ->add('email', EmailType::class, array('required' => false, 'label' => 'Электронная почта', 'attr' => array('class' => 'form-control')))
            ->add('username', TextType::class, array('required' => false, 'label' => 'Логин для входа', 'attr' => array('class' => 'form-control')))
            ->add('password', TextType::class, array('required' => false, 'mapped' => false,'label' => 'Новый пароль', 'attr' => array('class' => 'form-control', 'plceholder' => 'Новый пароль')))
            ->add('roles', 'entity', array( 'class' => 'ApplicationBoardBundle:Role',
                                                 'required' => true,
                                                 'choice_label' => 'name',
                                                 'label' => 'Роль',
                                                 'multiple' => true,
                                                 'expanded' => true,
                                                 'attr' => array('class' => 'form-control')))    
            ->getForm();
         
        $userForm->handleRequest($request);
        
        if($userForm->isSubmitted() && $userForm->isValid())
        {
            if($userForm['password']->getData())
            {
                $password = $this->get('security.password_encoder')->encodePassword($user, $userForm['password']->getData());
                $user->setPassword($password);
            }
            
            if(!$userId)
            {
                $user->setIsActive(1);
            }
            
            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash(
                'notice',
                $this->get('translator')->trans('<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Успешно!</strong> Информация сохранена.</div>')
            );
            
            return $this->redirectToRoute("boardUserEdit", array("userId" => $user->getId()));
        }
        
        return $this->render('@board/User/user.html.twig', array("userForm" => $userForm->createView()));
    }
}