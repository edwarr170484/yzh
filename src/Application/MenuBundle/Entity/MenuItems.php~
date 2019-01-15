<?php

namespace Application\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Application\MenuBundle\Entity\Menu;
use Application\AdminBundle\Entity\Page;
/**
 * @ORM\Table(name="menu_items")
 * @ORM\Entity()
 */

class MenuItems
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", length=15, nullable=true, options={"default":"null"})
     */
    private $parentId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\BoardBundle\Entity\Page", inversedBy="menuitems")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    private $page;
    
    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="items")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     **/
    private $menu;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true, options={"default":"null"})
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true, options={"default":"null"})
     */
    private $link;
        
    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer", nullable=true, options={"default":"null"})
     */
    private $sort;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="block", type="integer", nullable=true, options={"default":"null"})
     */
    private $block;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return MenuItems
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MenuItems
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return MenuItems
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     * @return MenuItems
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer 
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set block
     *
     * @param integer $block
     * @return MenuItems
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return integer 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set page
     *
     * @param \Application\BoardBundle\Entity\Page $page
     * @return MenuItems
     */
    public function setPage(\Application\BoardBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Application\BoardBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set menu
     *
     * @param \Application\MenuBundle\Entity\Menu $menu
     * @return MenuItems
     */
    public function setMenu(\Application\MenuBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Application\MenuBundle\Entity\Menu 
     */
    public function getMenu()
    {
        return $this->menu;
    }
}
