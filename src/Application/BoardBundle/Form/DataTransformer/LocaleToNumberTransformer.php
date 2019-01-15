<?php

namespace Application\AdminBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class LocaleToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function transform($locale)
    {
        if (null === $locale) {
            return '';
        }

        return $locale->getId();
    }
    
    public function reverseTransform($localeId)
    {
        if (!$localeId) {
            return;
        }

        $locale = $this->manager->getRepository('ApplicationAdminBundle:Locale')->find($localeId);

        if (null === $locale) {
            
            throw new TransformationFailedException(sprintf(
                'Locale with localeId "%s" does not exist!',
                $localeId
            ));
        }

        return $locale;
    }
}



