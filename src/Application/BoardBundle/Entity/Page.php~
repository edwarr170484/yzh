<?php
namespace Application\BoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\MenuBundle\Entity\MenuItems;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Page
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\MenuBundle\Entity\MenuItems", mappedBy="page")
     */
    private $menuitems;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $pageName;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $pageRoute;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $pageContent;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $metaTagTitle;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $metaTagDescription;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $metaTagKeywords;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $metaTagRobots;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $metaTagAuthor;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\BoardBundle\Entity\PageBlock", mappedBy="page", cascade={"persist"})
     * @ORM\OrderBy({"sortorder" = "ASC"})
     */
    private $blocks;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\BoardBundle\Entity\Locale", inversedBy="pages")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     */
    private $locale;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menuitems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blocks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set pageName
     *
     * @param string $pageName
     * @return Page
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }

    /**
     * Get pageName
     *
     * @return string 
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * Set pageRoute
     *
     * @param string $pageRoute
     * @return Page
     */
    public function setPageRoute($pageRoute)
    {
        $this->pageRoute = $pageRoute;

        return $this;
    }

    /**
     * Get pageRoute
     *
     * @return string 
     */
    public function getPageRoute()
    {
        return $this->pageRoute;
    }

    /**
     * Set pageContent
     *
     * @param string $pageContent
     * @return Page
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    /**
     * Get pageContent
     *
     * @return string 
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * Set metaTagTitle
     *
     * @param string $metaTagTitle
     * @return Page
     */
    public function setMetaTagTitle($metaTagTitle)
    {
        $this->metaTagTitle = $metaTagTitle;

        return $this;
    }

    /**
     * Get metaTagTitle
     *
     * @return string 
     */
    public function getMetaTagTitle()
    {
        return $this->metaTagTitle;
    }

    /**
     * Set metaTagDescription
     *
     * @param string $metaTagDescription
     * @return Page
     */
    public function setMetaTagDescription($metaTagDescription)
    {
        $this->metaTagDescription = $metaTagDescription;

        return $this;
    }

    /**
     * Get metaTagDescription
     *
     * @return string 
     */
    public function getMetaTagDescription()
    {
        return $this->metaTagDescription;
    }

    /**
     * Set metaTagKeywords
     *
     * @param string $metaTagKeywords
     * @return Page
     */
    public function setMetaTagKeywords($metaTagKeywords)
    {
        $this->metaTagKeywords = $metaTagKeywords;

        return $this;
    }

    /**
     * Get metaTagKeywords
     *
     * @return string 
     */
    public function getMetaTagKeywords()
    {
        return $this->metaTagKeywords;
    }

    /**
     * Set metaTagRobots
     *
     * @param string $metaTagRobots
     * @return Page
     */
    public function setMetaTagRobots($metaTagRobots)
    {
        $this->metaTagRobots = $metaTagRobots;

        return $this;
    }

    /**
     * Get metaTagRobots
     *
     * @return string 
     */
    public function getMetaTagRobots()
    {
        return $this->metaTagRobots;
    }

    /**
     * Set metaTagAuthor
     *
     * @param string $metaTagAuthor
     * @return Page
     */
    public function setMetaTagAuthor($metaTagAuthor)
    {
        $this->metaTagAuthor = $metaTagAuthor;

        return $this;
    }

    /**
     * Get metaTagAuthor
     *
     * @return string 
     */
    public function getMetaTagAuthor()
    {
        return $this->metaTagAuthor;
    }

    /**
     * Add menuitems
     *
     * @param \Application\MenuBundle\Entity\MenuItems $menuitems
     * @return Page
     */
    public function addMenuitem(\Application\MenuBundle\Entity\MenuItems $menuitems)
    {
        $this->menuitems[] = $menuitems;

        return $this;
    }

    /**
     * Remove menuitems
     *
     * @param \Application\MenuBundle\Entity\MenuItems $menuitems
     */
    public function removeMenuitem(\Application\MenuBundle\Entity\MenuItems $menuitems)
    {
        $this->menuitems->removeElement($menuitems);
    }

    /**
     * Get menuitems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenuitems()
    {
        return $this->menuitems;
    }

    /**
     * Add blocks
     *
     * @param \Application\BoardBundle\Entity\PageBlock $blocks
     * @return Page
     */
    public function addBlock(\Application\BoardBundle\Entity\PageBlock $blocks)
    {
        $this->blocks[] = $blocks;

        return $this;
    }

    /**
     * Remove blocks
     *
     * @param \Application\BoardBundle\Entity\PageBlock $blocks
     */
    public function removeBlock(\Application\BoardBundle\Entity\PageBlock $blocks)
    {
        $this->blocks->removeElement($blocks);
    }

    /**
     * Get blocks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * Set locale
     *
     * @param \Application\BoardBundle\Entity\Locale $locale
     * @return Page
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
