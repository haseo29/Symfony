<?php

namespace ALD\PremierTestBundle\AntiSpam;

class PTAntiSpam
{
    
    private $mailer;
    private $locale;
    private $minLength;
    
    public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
    {
        $this->mailer    =$mailer;
        $this->locale    =$locale;
        $this->minLength =(int) $minLength;
    }
    
    /**Vérifie si le text est un spam ou non
     * 
     * @param type $text
     * @return type
     */

    public function isSpam($text)
    {
        return strlen($text) < $this->minLength;
    }
}