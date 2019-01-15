<?php

namespace Application\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

use Application\MenuBundle\Entity\MenuItems;
use Application\AdminBundle\Entity\Page;

/**
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="Application\MenuBundle\Entity\MenuRepository")
 */
class Menu
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=10)
     */
    private $position;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;
    
    /**
     * @ORM\OneToMany(targetEntity="MenuItems", mappedBy="menu", cascade={"persist"})
     * @ORM\OrderBy({"sort"="ASC"})
     **/
    private $items;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\BoardBundle\Entity\Locale", inversedBy="menus")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     */
    private $locale;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Menu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Menu
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
     * Set position
     *
     * @param string $position
     * @return Menu
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     * @return Menu
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
     * Add items
     *
     * @param \Application\MenuBundle\Entity\MenuItems $items
     * @return Menu
     */
    public function addItem(\Application\MenuBundle\Entity\MenuItems $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Application\MenuBundle\Entity\MenuItems $items
     */
    public function removeItem(\Application\MenuBundle\Entity\MenuItems $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set locale
     *
     * @param \Application\BoardBundle\Entity\Locale $locale
     * @return Menu
     */
    public function setLocale(\Application\BoardBundle\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \Application\BoardBundle\Entity\Locale 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
