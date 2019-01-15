<?php
namespace Application\BoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Locale
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length = 10, nullable=true, options={"default":"null"})
     */
    private $code;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $country;
    
    /**
     * @ORM\Column(type="integer", length = 15, nullable=true, options={"default":"null"})
     */
    private $sortorder;
    
    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":"0"})
     */
    private $isActive;
    
    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":"0"})
     */
    private $isDefault;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\BoardBundle\Entity\Settings", mappedBy="locale", cascade={"persist"})
     */
    private $settings;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\BoardBundle\Entity\Currency", inversedBy="locale")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\MenuBundle\Entity\Menu", mappedBy="locale", cascade={"persist"})
     * @ORM\OrderBy({"sort"="ASC"})
     */
    private $menus;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\BoardBundle\Entity\Page", mappedBy="locale", cascade={"persist"})
     */
    private $pages;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\BlogBundle\Entity\Blog", mappedBy="locale", cascade={"persist"})
     * @ORM\OrderBy({"sortorder"="ASC"})
     */
    private $blogs;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\PortfolioBundle\Entity\PortfolioCategory", mappedBy="locale", cascade={"persist"})
     * @ORM\OrderBy({"sortorder"="ASC"})
     */
    private $portfolioCategories;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\PortfolioBundle\Entity\PortfolioItem", mappedBy="locale", cascade={"persist"})
     * @ORM\OrderBy({"sortorder"="ASC"})
     */
    private $portfolioItems;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Locale
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
     * Set code
     *
     * @param string $code
     * @return Locale
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Locale
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     * @return Locale
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;

        return $this;
    }

    /**
     * Get sortorder
     *
     * @return integer 
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Locale
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Locale
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set settings
     *
     * @param \Application\BoardBundle\Entity\Settings $settings
     * @return Locale
     */
    public function setSettings(\Application\BoardBundle\Entity\Settings $settings = null)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get settings
     *
     * @return \Application\BoardBundle\Entity\Settings 
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set currency
     *
     * @param \Application\BoardBundle\Entity\Currency $currency
     * @return Locale
     */
    public function setCurrency(\Application\BoardBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Application\BoardBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Add menus
     *
     * @param \Application\MenuBundle\Entity\Menu $menus
     * @return Locale
     */
    public function addMenu(\Application\MenuBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;

        return $this;
    }

    /**
     * Remove menus
     *
     * @param \Application\MenuBundle\Entity\Menu $menus
     */
    public function removeMenu(\Application\MenuBundle\Entity\Menu $menus)
    {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Add pages
     *
     * @param \Application\BoardBundle\Entity\Page $pages
     * @return Locale
     */
    public function addPage(\Application\BoardBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;

        return $this;
    }

    /**
     * Remove pages
     *
     * @param \Application\BoardBundle\Entity\Page $pages
     */
    public function removePage(\Application\BoardBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add blogs
     *
     * @param \Application\BlogBundle\Entity\Blog $blogs
     * @return Locale
     */
    public function addBlog(\Application\BlogBundle\Entity\Blog $blogs)
    {
        $this->blogs[] = $blogs;

        return $this;
    }

    /**
     * Remove blogs
     *
     * @param \Application\BlogBundle\Entity\Blog $blogs
     */
    public function removeBlog(\Application\BlogBundle\Entity\Blog $blogs)
    {
        $this->blogs->removeElement($blogs);
    }

    /**
     * Get blogs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlogs()
    {
        return $this->blogs;
    }

    /**
     * Add portfolioCategories
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioCategory $portfolioCategories
     * @return Locale
     */
    public function addPortfolioCategory(\Application\PortfolioBundle\Entity\PortfolioCategory $portfolioCategories)
    {
        $this->portfolioCategories[] = $portfolioCategories;

        return $this;
    }

    /**
     * Remove portfolioCategories
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioCategory $portfolioCategories
     */
    public function removePortfolioCategory(\Application\PortfolioBundle\Entity\PortfolioCategory $portfolioCategories)
    {
        $this->portfolioCategories->removeElement($portfolioCategories);
    }

    /**
     * Get portfolioCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortfolioCategories()
    {
        return $this->portfolioCategories;
    }

    /**
     * Add portfolioItems
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioItem $portfolioItems
     * @return Locale
     */
    public function addPortfolioItem(\Application\PortfolioBundle\Entity\PortfolioItem $portfolioItems)
    {
        $this->portfolioItems[] = $portfolioItems;

        return $this;
    }

    /**
     * Remove portfolioItems
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioItem $portfolioItems
     */
    public function removePortfolioItem(\Application\PortfolioBundle\Entity\PortfolioItem $portfolioItems)
    {
        $this->portfolioItems->removeElement($portfolioItems);
    }

    /**
     * Get portfolioItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortfolioItems()
    {
        return $this->portfolioItems;
    }
}
