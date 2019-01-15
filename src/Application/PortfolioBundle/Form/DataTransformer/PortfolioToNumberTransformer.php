<?php

namespace Application\PortfolioBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class PortfolioToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function transform($portfolioItem)
    {
        if (null === $portfolioItem) {
            return '';
        }

        return $portfolioItem->getId();
    }
    
    public function reverseTransform($portfolioItemId)
    {
        if (!$portfolioItemId) {
            return;
        }

        $portfolioItem = $this->manager->getRepository('ApplicationPortfolioBundle:PortfolioItem')->find($portfolioItemId);

        if (null === $portfolioItem) {
            
            throw new TransformationFailedException(sprintf(
                'PortfolioItem with id "%s" does not exist!',
                $portfolioItemId
            ));
        }

        return $portfolioItem;
    }
}



