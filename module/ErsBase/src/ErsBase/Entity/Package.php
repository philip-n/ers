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
 * ErsBase\Entity\Package
 *
 * @ORM\Entity()
 * @ORM\Table(name="package", indexes={@ORM\Index(name="fk_Package_User1_idx", columns={"participant_id"}), @ORM\Index(name="fk_package_package1_idx", columns={"transferred_package_id"}), @ORM\Index(name="fk_package_code1_idx", columns={"code_id"}), @ORM\Index(name="fk_package_order1_idx", columns={"order_id"}), @ORM\Index(name="fk_package_status1_idx", columns={"status_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class Package extends Base\Package
{
    public function __construct()
    {
        parent::__construct();
        $code = new Code();
        $code->genCode();
        $this->setCode($code);
    }
    
    /**
     * Set id of this object to null if it's cloned
     */
    public function __clone() {
        $this->id = null;
        #$this->session_id = null;
        
        $this->items = new ArrayCollection();
        
        # generate new code for new package
        $code = new Code();
        $code->genCode();
        $this->setCode($code);
        
        $this->setOrder(null);
        $this->setOrderId(null);
        
        $this->created = null;
    }
    
    public function __toString() {
        $output = '';
        $output .= $this->getParticipant();
        
        foreach($this->getItems() as $item) {
            $output .= $item.PHP_EOL;
        }
        
        return $output;
    }
    
    /**
    * @ORM\PreRemove
    */
    /*public function deleteAllItems()
    {
        foreach ($this->getItems() as $item) {
            error_log('remove item from package: '.$item->getName());
            $this->removeItem($item);
            $item->setPackage(null);
        }
    }*/
    
    /**
     * Set User entity (many to one).
     *
     * @param \ErsBase\Entity\Base\User $user
     * @return \ErsBase\Entity\Base\Package
     */
    public function setParticipant(User $user = null)
    {
        $this->setUser($user);

        return $this;
    }
    
    /**
     * Get User entity (many to one).
     *
     * @return \ErsBase\Entity\Base\User
     */
    public function getParticipant()
    {
        return $this->getUser();
    }

    /**
     * Add Item entity to collection (one to many).
     *
     * @param \Entity\Item $item
     * @return \Entity\Package
     */
    public function addItem(Item $item)
    {
        $item->setPackage($this);
        foreach($item->getChildItems() as $cItem) {
            $cItem->setPackage($this);
            $cItem->setPackageId($this->getId());
        }
        
        $this->items[] = $item;

        return $this;
    }
    
    /**
     * Remove Item entity by id
     * 
     * @param type $id
     */
    public function removeItemById($id) {
        $item = $this->getItemById($id);
        if(!$item) {
            throw new \Exception('Unable to remove item with id '.$id);
        }
        return $this->removeItem($item);
    }
    
    /**
     * Remove Item entity from collection (one to many).
     *
     * @param \ErsBase\Entity\Base\Item $item
     * @return \ErsBase\Entity\Base\Package
     */
    public function removeItem(Item $item)
    {
        foreach($item->getChildItems() as $cItem) {
            $this->items->removeElement($cItem);
        }
        $this->items->removeElement($item);

        return $this;
    }

    /**
     * Get Item entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        $items = new ArrayCollection();
        foreach($this->items as $item) {
            if($item->getStatus() == 'cancelled') {
                continue;
            }
            $items[] = $item;
        }
        return $items;
    }
    
    /**
     * Get Item entity by array id.
     *
     * @return \Entity\Item
     */
    public function getItemById($id) {
        foreach($this->getItems() as $item) {
            if($item->getId() == $id) {
                return $item;
            }
        }
        return false;
    }
    
    /**
     * Check if item exists
     * 
     * @param \ErsBase\Entity\Item $item
     * @return boolean
     */
    public function existItem(Item $item) {
        $key = array_search($item, $this->getItems()->toArray(), true);

        if ($key !== false) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if this package already contains a personalized ticket
     * 
     * @return boolean
     */
    public function hasPersonalizedItem() {
        foreach($this->getItems() as $item) {
            if($item->getPersonalized()) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Set the value of transferred_package.
     *
     * @param Package $package
     * @return \Entity\Package
     */
    public function setTransferredPackage(Package $package = null)
    {
        $this->transferred_package = $package;

        return $this;
    }

    /**
     * Get the value of transferred_package.
     *
     * @return Package
     */
    public function getTransferredPackage()
    {
        return $this->transferred_package;
    }
    
    /*
     * Equivalent to getStatus(), but also considers the shipped status of the item.
     * Introduced for display in Onsite, implemented as a separate method so it does not break anything else status-related.
     * 
     * @return string
     */
    public function getStatusWithShipped() {
        $status = array();
        foreach($this->getItems() as $item) {
            $item_status = $item->getStatus()->getValue();
            if($item->getShipped()) {
                $item_status = 'shipped';
            }
            elseif($item_status == 'zero_ok') {
                $item_status = 'paid';
            }
            
            if(isset($status[$item_status])) {
                $status[$item_status]++;
            } else {
                $status[$item_status] = 1;
            }
        }
        if(count($status) == 1) {
            return key($status);
        } else {
            return 'undefined';
        }
    }
    
    public function getAllItems() {
        return $this->items;
    }
}
