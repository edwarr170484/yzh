<?php

namespace Application\MenuBundle\Entity;

class MenuRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllMenus()
    {       
        $em = $this->getEntityManager();
        $menu = $em->createQuery("SELECT m FROM ApplicationMenuBundle:Menu m ORDER BY m.sort ASC");
        
        return $menu->getResult();
    }
    
    public function menuCount()
    {
        $em = $this->getEntityManager();
        $menu = $em->createQuery("SELECT m FROM ApplicationMenuBundle:Menu m")->getResult();
        
        return count($menu);
    }
}
