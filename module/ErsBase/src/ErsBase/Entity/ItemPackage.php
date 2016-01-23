<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-realentity) on 2016-01-13 10:01:52.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErsBase\Entity\ItemPackage
 *
 * @ORM\Entity()
 * @ORM\Table(name="item_package", indexes={@ORM\Index(name="fk_item_package_item1_idx", columns={"Subitem_id"}), @ORM\Index(name="fk_item_package_item2_idx", columns={"Suritem_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class ItemPackage extends Base\ItemPackage
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setSurItem($item) {
        return $this->setItemRelatedBySurItemId($item);
    }
    public function getSurItem() {
        return $this->getItemRelatedBySurItemId();
    }
    
    public function setSubItem($item) {
        return $this->setItemRelatedBySubItemId($item);
    }
    public function getSubItem() {
        return $this->getItemRelatedBySubItemId();
    }
}