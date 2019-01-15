<?php
namespace Application\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PortfolioImage
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
    private $image;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $alt;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $title;
    
    /**
     * @ORM\Column(type="integer", length = 15, nullable=true, options={"default":"null"})
     */
    private $sortorder;
    
    /**
     * @ORM\Column(type="string", length = 512, nullable=true, options={"default":"null"})
     */
    private $style;
   
    /**
     * @ORM\ManyToOne(targetEntity="Application\PortfolioBundle\Entity\PortfolioItem", inversedBy="portfolioImages")
     * @ORM\JoinColumn(name="portfolio_id", referencedColumnName="id")
     */
    private $portfolioItem;

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
     * @return PortfolioImage
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
     * Set portfolioItem
     *
     * @param \Application\PortfolioBundle\Entity\PortfolioItem $portfolioItem
     * @return PortfolioImage
     */
    public function setPortfolioItem(\Application\PortfolioBundle\Entity\PortfolioItem $portfolioItem = null)
    {
        $this->portfolioItem = $portfolioItem;

        return $this;
    }

    /**
     * Get portfolioItem
     *
     * @return \Application\PortfolioBundle\Entity\PortfolioItem 
     */
    public function getPortfolioItem()
    {
        return $this->portfolioItem;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return PortfolioImage
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return PortfolioImage
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return PortfolioImage
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
     * Set style
     *
     * @param string $style
     * @return PortfolioImage
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
