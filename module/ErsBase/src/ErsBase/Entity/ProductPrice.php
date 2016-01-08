<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-realentity) on 2016-01-07 08:26:28.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErsBase\Entity\ProductPrice
 *
 * @ORM\Entity()
 * @ORM\Table(name="product_price", indexes={@ORM\Index(name="fk_ProductPrice_Product1_idx", columns={"Product_id"}), @ORM\Index(name="fk_ProductPrice_Deadline1_idx", columns={"Deadline_id"}), @ORM\Index(name="fk_ProductPrice_Counter1_idx", columns={"Counter_id"}), @ORM\Index(name="fk_ProductPrice_Currency1_idx", columns={"Currency_id"}), @ORM\Index(name="fk_ProductPrice_Agegroup1_idx", columns={"Agegroup_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class ProductPrice extends Base\ProductPrice
{
    public function __construct()
    {
        parent::__construct();
    }

}