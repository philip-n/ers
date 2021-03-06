<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-realentity) on 2016-01-07 08:26:28.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ErsBase\Entity\Product
 *
 * @ORM\Entity()
 * @ORM\Table(name="product", indexes={@ORM\Index(name="fk_product_tax1_idx", columns={"tax_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class Product extends Base\Product
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set id of this object to null if it's cloned
     */
    public function __clone() {
        $this->id = null;
        
        $prices = $this->getProductPrices();
        $this->productPrices = new ArrayCollection();
        foreach ($prices as $price) {
            $clonePrice = clone $price;
            $this->addProductPrice($clonePrice);
            $clonePrice->setProduct($this);
        }
        
        $variants = $this->getProductVariants();
        $this->productVariants = new ArrayCollection();
        foreach ($variants as $variant) {
            $cloneVariant = clone $variant;
            $this->addProductVariant($cloneVariant);
            $cloneVariant->setProduct($this);
        }
    }

    /**
     * Get prices by agegroup
     * 
     * @param \ErsBase\Entity\Agegroup $agegroup
     * @return type
     */
    public function getProductPrice(Agegroup $agegroup = null, Deadline $deadline = null, $currency = null, $search = true) {
        $debug = false;
        if($debug) {
            error_log('=== START DEBUGGING: getProductPrice ===');
            if($agegroup) {
                error_log($this->getId().': agegroup: '.$agegroup->getName());
            } else {
                error_log($this->getId().': no agegroup');
            }
            if($deadline) {
                error_log($this->getId().': deadline: '.$deadline->getName());
            } else {
                error_log($this->getId().': no deadline');
            }
            error_log($this->getId().': found '.count($this->getProductPrices()).' prices');
        }
        
        #$ret = new ProductPrice();
        $ret = null;
        foreach($this->getProductPrices() as $price) {
            /* 
             * if a agegroup is given but price has none
             */
            if($price->getAgegroup() == null && $agegroup != null) {
                if($debug) {
                    error_log($this->getId().': price has an agegroup');
                }
                continue;
            }
            /* 
             * if a deadline is given but price has none
             */
            if($price->getDeadline() == null && $deadline != null) {
                if($debug) {
                    error_log($this->getId().': price has a deadline');
                }
                continue;
            }
            /*
             * if no agegroup is given but price has one
             */
            if($price->getAgegroup() != null && $agegroup == null) {
                if($debug) {
                    error_log($this->getId().': price has no agegroup');
                }
                continue;
            }
            /*
             * if no deadline is given but price has one
             */
            if($price->getDeadline() != null && $deadline == null) {
                if($debug) {
                    error_log($this->getId().': price has no deadline');
                }
                continue;
            }
            /*
             * if agegroup does not match
             */
            if($price->getAgegroup() != null && $agegroup != null && $price->getAgegroup()->getId() != $agegroup->getId()) {
                if($debug) {
                    error_log($this->getId().': agegroups do not match ('.$price->getAgegroup()->getId().' != '.$agegroup->getId().')');
                }
                continue;
            }
            /*
             * if deadline does not match
             */
            if($price->getDeadline() != null && $deadline != null && $price->getDeadline()->getId() != $deadline->getId()) {
                if($debug) {
                    error_log($this->getId().': deadlines do not match ('.$price->getDeadline()->getId().' != '.$deadline->getId().')');
                }
                continue;
            }
            /*
             * if currency does not match
             */
            if($currency != null) {
                if(is_object($currency)) {
                    if($price->getCurrency() != null && $price->getCurrency()->getId() != $currency->getId()) {
                        if($debug) {
                            error_log($this->getId().': currencies are object, but do not match ('.$price->getCurrency()->getId().' != '.$currency->getId().')');
                        }
                        continue;
                    }
                } else {
                    if($price->getCurrency() != null && $price->getCurrency()->getShort() != $currency) {
                        if($debug) {
                            error_log($this->getId().': currencies are strings, but do not match ('.$price->getCurrency()->getShort().' != '.$currency.')');
                        }
                        continue;
                    }
                }
            }
            
            
            /*
             * at this point we should only have the prices we want, take the highest one.
             */
            if($ret == null || $ret->getCharge() < $price->getCharge()) {
                if($debug) {
                    error_log($this->getId().': set ret to price: '.$price->getCharge().' id: '.$price->getId());
                }
                $ret = $price;
            }
        }
        
        if(($ret == null || $ret->getCharge() == null) && $search) {
            if($debug) {
                error_log($this->getId().': start searching for a valid price...');
            }
            /*
             * start search only by agegroup
             */
            $ret = $this->getProductPrice($agegroup, null, $currency, false);
            if($ret == null) {
                $ret = $this->getProductPrice(null, null, $currency, false);
            }
            if($ret->getCharge() == null) {
                $ret = $this->getProductPrice(null, null, $currency, false);
            }
        }
        
        
        if($debug) {
            if($ret != null) {
                error_log($this->getId().': found valid price: '.$price->getCharge().' id: '.$price->getId());
            }
            error_log('=== END DEBUGGING: getProductPrice ===');
        }
        
        return $ret;
    }
    
    public function getPriceCount() {
        return \count($this->getProductPrices());
    }
    
    /**
     * Get former prices for this product
     * 
     * @return array of \Entity\ProductPrice
     */
    public function getFormerPrices()
    {
        $now = new \DateTime();
        $diff = 0;
        $ret = new ArrayCollection();
        foreach($this->getProductPrices() as $price) {
            if($now > $price->getDeadline()->getDeadline()) {
                $ret[] = $price; 
            }
        }
        return $ret;
    }
    public function getFuturePrices()
    {
        $now = new \DateTime();
        $diff = 0;
        $ret = new ArrayCollection();
        foreach($this->getProductPrices() as $price) {
            if($now < $price->getDeadline()->getDeadline()) {
                $ret[] = $price; 
            }
        }
        return $ret;
    }
    
    public function getChildProducts() {
        return $this->getProductPackageRelatedByProductIds();
    }
    
    public function getParentProducts() {
        return $this->getProductPackageRelatedBySubProductIds();
    }
    
    public function getProductVariantByName($name) {
        foreach($this->getProductVariants() as $variant) {
            if($variant->getName() == $name) {
                return $variant;
            }
        }
        return false;
    }
}
