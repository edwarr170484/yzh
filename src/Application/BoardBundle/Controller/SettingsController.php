<?php

namespace Application\BoardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SettingsController extends Controller
{
    /**
     * @Route("/board/settings", name="settingsBoard")
     */
    public function settingsAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locales = $manager->getRepository("ApplicationBoardBundle:Locale")->findBy(array(), array("sortorder" => "ASC"));
        $defaultLocale = $manager->getRepository("ApplicationBoardBundle:Locale")->findOneBy(array("isDefault" => true));
        
        $fm = new Filesystem();
        $settingFroms = array();
        
        foreach($locales as $locale)
        {
             $settingsForms[$locale->getCode()] = $this->get('form.factory')->createNamedBuilder('settings_' . $locale->getCode(), 'form', $locale->getSettings())
                ->add('siteName', TextType::class, array('required' => false, 'label' => 'Название сайта:', 'attr' => array('class' => 'form-control')))
                ->add('settingsEmail', TextType::class, array('required' => false, 'label' => 'E-Mail:', 'attr' => array('class' => 'form-control')))
                ->add('settingsPhone', TextType::class, array('required' => false, 'label' => 'Телефон:', 'attr' => array('class' => 'form-control')))
                ->add('socialVk', TextType::class, array('required' => false, 'label' => 'Vkontakte:', 'attr' => array('class' => 'form-control')))
                ->add('socialYoutube', TextType::class, array('required' => false, 'label' => 'Youtube:', 'attr' => array('class' => 'form-control')))
                ->add('socialInstagram', TextType::class, array('required' => false, 'label' => 'Instagram:', 'attr' => array('class' => 'form-control')))     
                ->add('socialFacebook', TextType::class, array('required' => false, 'label' => 'Facebook:', 'attr' => array('class' => 'form-control')))    
                ->add('searchGoogle', TextareaType::class, array('required' => false, 'label' => 'Google Analitics:', 'attr' => array('class' => 'form-control')))
                ->add('searchYandex', TextareaType::class, array('required' => false, 'label' => 'Yandex Metrika:', 'attr' => array('class' => 'form-control')))
                ->add('logotype', HiddenType::class, array('required' => false))
                ->add('logotypeNew', FileType::class, array('required' => false, 'label' => 'Логотип сайта:', 'mapped' => false, 'attr' => array('class' => 'form-control')))
                ->add('copyright', TextType::class, array('required' => false, 'label' => 'Копирайт:', 'attr' => array('class' => 'form-control')))
                ->getForm();
        }
        
        foreach($locales as $locale)
        {
            $settingsForms[$locale->getCode()]->handleRequest($request);
            
            if($settingsForms[$locale->getCode()]->isValid())
            {
                $siteLogo = $settingsForms[$locale->getCode()]['logotypeNew']->getData();
                $oldsiteLogo = $settingsForms[$locale->getCode()]['logotype']->getData();

                if($siteLogo)
                {
                    if($oldsiteLogo)
                    {
                        if($fm->exists($request->server->get('DOCUMENT_ROOT') . '/bundles/images/site/' . $oldsiteLogo ))
                        {
                            $fm->remove($request->server->get('DOCUMENT_ROOT') . '/bundles/images/site/' . $oldsiteLogo );
                        }
                    }
                    $extention = $siteLogo->getClientOriginalExtension();
                    $localImageName = rand(1, 99999999).'.'.$extention;
                    $siteLogo->move('bundles/images/site',$localImageName);
                    $locale->getSettings()->setLogotype($localImageName);
                }

                $manager->persist($locale->getSettings());
                $manager->flush();

                $this->addFlash(
                    'notice',
                    $this->get('translator')->trans('<div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Успешно!</strong> Настройки для локализации <strong>' . $locale->getName() . '</strong> сохранены.</div>')
                );

                return $this->redirectToRoute('settingsBoard');
            }
        }
        
        $settingFromsViews = array();
        
        foreach($settingsForms as $key => $value)
        {
            $settingFromsViews[$key] = $value->createView();
        }
        
        return $this->render('@board/Settings/settings.html.twig', array("locales" => $locales, "settingsForms" => $settingFromsViews));
    }
}

