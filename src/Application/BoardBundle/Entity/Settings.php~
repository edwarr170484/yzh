<?php
namespace Application\BoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Settings
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text")
     */
    private $siteName;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $settingsEmail;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $settingsPhone;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $socialVk;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $socialYoutube;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $socialInstagram;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $socialFacebook;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $searchGoogle;
    
    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"null"})
     */
    private $searchYandex;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $logotype;
    
    /**
     * @ORM\Column(type="string", length = 255, nullable=true, options={"default":"null"})
     */
    private $copyright;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\BoardBundle\Entity\Locale", inversedBy="settings")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
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
     * Set siteName
     *
     * @param string $siteName
     * @return Settings
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string 
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set settingsEmail
     *
     * @param string $settingsEmail
     * @return Settings
     */
    public function setSettingsEmail($settingsEmail)
    {
        $this->settingsEmail = $settingsEmail;

        return $this;
    }

    /**
     * Get settingsEmail
     *
     * @return string 
     */
    public function getSettingsEmail()
    {
        return $this->settingsEmail;
    }

    /**
     * Set settingsPhone
     *
     * @param string $settingsPhone
     * @return Settings
     */
    public function setSettingsPhone($settingsPhone)
    {
        $this->settingsPhone = $settingsPhone;

        return $this;
    }

    /**
     * Get settingsPhone
     *
     * @return string 
     */
    public function getSettingsPhone()
    {
        return $this->settingsPhone;
    }

    /**
     * Set socialVk
     *
     * @param string $socialVk
     * @return Settings
     */
    public function setSocialVk($socialVk)
    {
        $this->socialVk = $socialVk;

        return $this;
    }

    /**
     * Get socialVk
     *
     * @return string 
     */
    public function getSocialVk()
    {
        return $this->socialVk;
    }

    /**
     * Set socialYoutube
     *
     * @param string $socialYoutube
     * @return Settings
     */
    public function setSocialYoutube($socialYoutube)
    {
        $this->socialYoutube = $socialYoutube;

        return $this;
    }

    /**
     * Get socialYoutube
     *
     * @return string 
     */
    public function getSocialYoutube()
    {
        return $this->socialYoutube;
    }

    /**
     * Set socialInstagram
     *
     * @param string $socialInstagram
     * @return Settings
     */
    public function setSocialInstagram($socialInstagram)
    {
        $this->socialInstagram = $socialInstagram;

        return $this;
    }

    /**
     * Get socialInstagram
     *
     * @return string 
     */
    public function getSocialInstagram()
    {
        return $this->socialInstagram;
    }

    /**
     * Set socialFacebook
     *
     * @param string $socialFacebook
     * @return Settings
     */
    public function setSocialFacebook($socialFacebook)
    {
        $this->socialFacebook = $socialFacebook;

        return $this;
    }

    /**
     * Get socialFacebook
     *
     * @return string 
     */
    public function getSocialFacebook()
    {
        return $this->socialFacebook;
    }

    /**
     * Set searchGoogle
     *
     * @param string $searchGoogle
     * @return Settings
     */
    public function setSearchGoogle($searchGoogle)
    {
        $this->searchGoogle = $searchGoogle;

        return $this;
    }

    /**
     * Get searchGoogle
     *
     * @return string 
     */
    public function getSearchGoogle()
    {
        return $this->searchGoogle;
    }

    /**
     * Set searchYandex
     *
     * @param string $searchYandex
     * @return Settings
     */
    public function setSearchYandex($searchYandex)
    {
        $this->searchYandex = $searchYandex;

        return $this;
    }

    /**
     * Get searchYandex
     *
     * @return string 
     */
    public function getSearchYandex()
    {
        return $this->searchYandex;
    }

    /**
     * Set logotype
     *
     * @param string $logotype
     * @return Settings
     */
    public function setLogotype($logotype)
    {
        $this->logotype = $logotype;

        return $this;
    }

    /**
     * Get logotype
     *
     * @return string 
     */
    public function getLogotype()
    {
        return $this->logotype;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return Settings
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set locale
     *
     * @param \Application\BoardBundle\Entity\Locale $locale
     * @return Settings
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
