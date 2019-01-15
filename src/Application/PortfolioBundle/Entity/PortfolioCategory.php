<?php
namespace Application\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PortfolioCategory
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
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $description;
    
    /**
     * @ORM\Column(type="integer", length = 15, nullable=true, options={"default":"null"})
     */
    private $sortorder;
    
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
     * @ORM\OneToMany(targetEntity="Application\PortfolioBundle\Entity\PortfolioItem", mappedBy="portfolioCategory", cascade={"persist"})
     * @ORM\OrderBy({"sortorder"="ASC"})
     */
    private $portfolioItems;
   
    /**
     * @ORM\ManyToOne(targetEntity="Application\BoardBundle\Entity\Locale", inversedBy="portfolioCategories")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     */
    private $locale;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolioItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set sortorder
     *
     * @param integer $sortorder
     * @return PortfolioCategory
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
     * Add portfolioItems
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioItem $portfolioItems
     * @return PortfolioCategory
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

    /**
     * Set locale
     *
     * @param \Application\BoardBundle\Entity\Locale $locale
     * @return PortfolioCategory
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

    /**
     * Set name
     *
     * @param string $name
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
     * Set description
     *
     * @param string $description
     * @return PortfolioCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set metaTagTitle
     *
     * @param string $metaTagTitle
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
}
