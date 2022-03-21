<?php

class Image{

    private $idImage;
    private $image;
    private $estPrincipale;
    private $idSalle;
    

    /**
     * Get the value of idImage
     */ 
    public function getIdImage()
    {
        return $this->idImage;
    }

    /**
     * Set the value of idImage
     *
     * @return  self
     */ 
    public function setIdImage($idImage)
    {
        $this->idImage = $idImage;

        return $this;
    }

    /**
     * Get the value of nomImage
     */ 
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * Set the value of nomImage
     *
     * @return  self
     */ 
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    /**
     * Get the value of estPrincipale
     */ 
    public function getEstPrincipale()
    {
        return $this->estPrincipale;
    }

    /**
     * Set the value of estPrincipale
     *
     * @return  self
     */ 
    public function setEstPrincipale($estPrincipale)
    {
        $this->estPrincipale = $estPrincipale;

        return $this;
    }

    /**
     * Get the value of idSalle
     */ 
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * Set the value of idSalle
     *
     * @return  self
     */ 
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}


?>