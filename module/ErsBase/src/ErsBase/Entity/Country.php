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
 * ErsBase\Entity\Country
 *
 * @ORM\Entity()
 * @ORM\Table(name="country")
 * @ORM\HasLifecycleCallbacks
 */
class Country extends Base\Country
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __toString() {
        return $this->getName();
    }
}