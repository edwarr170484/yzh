<?php
namespace Application\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PortfolioItem
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
     * @ORM\Column(type="datetime")
     */
    private $dateAdded;
    
    /**
     * @ORM\Column(type="integer", length = 15, nullable=true, options={"default":"null"})
     */
    private $sortorder;
    
    /**
     * @ORM\Column(type="string", length = 512, nullable=true, options={"default":"null"})
     */
    private $style;
    
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
     * @ORM\OneToMany(targetEntity="Application\PortfolioBundle\Entity\PortfolioImage", mappedBy="portfolioItem", cascade={"persist"})
     * @ORM\OrderBy({"sortorder"="ASC"})
     */
    private $portfolioImages;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\PortfolioBundle\Entity\PortfolioCategory", inversedBy="portfolioItems")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $portfolioCategory;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\BoardBundle\Entity\Locale", inversedBy="portfolioItems")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     */
    private $locale;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolioImages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return PortfolioItem
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
     * Add portfolioImages
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioImage $portfolioImages
     * @return PortfolioItem
     */
    public function addPortfolioImage(\Application\PortfolioBundle\Entity\PortfolioImage $portfolioImages)
    {
        $this->portfolioImages[] = $portfolioImages;

        return $this;
    }

    /**
     * Remove portfolioImages
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioImage $portfolioImages
     */
    public function removePortfolioImage(\Application\PortfolioBundle\Entity\PortfolioImage $portfolioImages)
    {
        $this->portfolioImages->removeElement($portfolioImages);
    }

    /**
     * Get portfolioImages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortfolioImages()
    {
        return $this->portfolioImages;
    }

    /**
     * Set portfolioCategory
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioCategory $portfolioCategory
     * @return PortfolioItem
     */
    public function setPortfolioCategory(\Application\PortfolioBundle\Entity\PortfolioCategory $portfolioCategory = null)
    {
        $this->portfolioCategory = $portfolioCategory;

        return $this;
    }

    /**
     * Get portfolioCategory
     *
     * @return \Application\PortfolioBundle\Entity\PortfolioCategory 
     */
    public function getPortfolioCategory()
    {
        return $this->portfolioCategory;
    }

    /**
     * Set locale
     *
     * @param \Application\BoardBundle\Entity\Locale $locale
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return PortfolioItem
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set style
     *
     * @param string $style
     * @return PortfolioItem
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string 
     */
    public function getStyle()
    {
        return $this->style;
    }
}
