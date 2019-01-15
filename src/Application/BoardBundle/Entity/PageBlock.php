<?php
namespace Application\BoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PageBlock 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\BoardBundle\Entity\Page", inversedBy="blocks")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    private $page;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $blockContent;
    
    /**
     * @ORM\Column(type="integer", length = 15, nullable=true, options={"default":"null"})
     */
    private $sortorder;


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
     * Set blockContent
     *
     * @param string $blockContent
     * @return PageBlock
     */
    public function setBlockContent($blockContent)
    {
        $this->blockContent = $blockContent;

        return $this;
    }

    /**
     * Get blockContent
     *
     * @return string 
     */
    public function getBlockContent()
    {
        return $this->blockContent;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     * @return PageBlock
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
     * Set page
     *
     * @param \Application\BoardBundle\Entity\Page $page
     * @return PageBlock
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
}
