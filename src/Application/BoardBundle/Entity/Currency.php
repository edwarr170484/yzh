<?php
namespace Application\BoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\MenuBundle\Entity\MenuItems;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Currency
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length = 255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length = 255)
     */
    private $code;
    
    /**
     * @ORM\Column(type="float", length = 255)
     */
    private $kurs;
    
    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":"0"})
     */
    private $isDefault;
    
    /**
     * @ORM\Column(type="integer", length = 15, nullable=true, options={"default":"0"})
     */
    private $sortorder;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\BoardBundle\Entity\Locale", mappedBy="currency", cascade={"persist"})
     */
    private $locale;


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
     * @return Currency
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
     * @return Currency
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
     * Set kurs
     *
     * @param float $kurs
     * @return Currency
     */
    public function setKurs($kurs)
    {
        $this->kurs = $kurs;
    
        return $this;
    }

    /**
     * Get kurs
     *
     * @return float 
     */
    public function getKurs()
    {
        return $this->kurs;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Currency
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
     * Set sortorder
     *
     * @param integer $sortorder
     * @return Currency
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
     * Set locale
     *
     * @param \Application\BoardBundle\Entity\Locale $locale
     * @return Currency
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
