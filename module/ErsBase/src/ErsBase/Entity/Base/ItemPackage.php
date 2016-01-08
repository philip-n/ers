<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-mappedsuperclass) on 2016-01-08 11:31:53.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErsBase\Entity\Base\ItemPackage
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(name="item_package", indexes={@ORM\Index(name="fk_ItemPackage_Item1_idx", columns={"SurItem_id"}), @ORM\Index(name="fk_ItemPackage_Item2_idx", columns={"SubItem_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class ItemPackage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $SurItem_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $SubItem_id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="itemPackageRelatedBySurItemIds", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="SurItem_id", referencedColumnName="id")
     */
    protected $itemRelatedBySurItemId;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="itemPackageRelatedBySubItemIds", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="SubItem_id", referencedColumnName="id")
     */
    protected $itemRelatedBySubItemId;

    public function __construct()
    {
    }

    /**
     * @ORM\PrePersist
     */
    public function PrePersist()
    {
        if(!isset($this->created)) {
            $this->created = new \DateTime();
        }
        $this->updated = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function PreUpdate()
    {
        $this->updated = new \DateTime();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of SurItem_id.
     *
     * @param integer $SurItem_id
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setSurItemId($SurItem_id)
    {
        $this->SurItem_id = $SurItem_id;

        return $this;
    }

    /**
     * Get the value of SurItem_id.
     *
     * @return integer
     */
    public function getSurItemId()
    {
        return $this->SurItem_id;
    }

    /**
     * Set the value of SubItem_id.
     *
     * @param integer $SubItem_id
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setSubItemId($SubItem_id)
    {
        $this->SubItem_id = $SubItem_id;

        return $this;
    }

    /**
     * Get the value of SubItem_id.
     *
     * @return integer
     */
    public function getSubItemId()
    {
        return $this->SubItem_id;
    }

    /**
     * Set the value of amount.
     *
     * @param string $amount
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of amount.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of updated.
     *
     * @param \DateTime $updated
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get the value of updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of created.
     *
     * @param \DateTime $created
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set Item entity related by `SurItem_id` (many to one).
     *
     * @param \ErsBase\Entity\Base\Item $item
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setItemRelatedBySurItemId(Item $item = null)
    {
        $this->itemRelatedBySurItemId = $item;

        return $this;
    }

    /**
     * Get Item entity related by `SurItem_id` (many to one).
     *
     * @return \ErsBase\Entity\Base\Item
     */
    public function getItemRelatedBySurItemId()
    {
        return $this->itemRelatedBySurItemId;
    }

    /**
     * Set Item entity related by `SubItem_id` (many to one).
     *
     * @param \ErsBase\Entity\Base\Item $item
     * @return \ErsBase\Entity\Base\ItemPackage
     */
    public function setItemRelatedBySubItemId(Item $item = null)
    {
        $this->itemRelatedBySubItemId = $item;

        return $this;
    }

    /**
     * Get Item entity related by `SubItem_id` (many to one).
     *
     * @return \ErsBase\Entity\Base\Item
     */
    public function getItemRelatedBySubItemId()
    {
        return $this->itemRelatedBySubItemId;
    }

    /**
     * Populate entity with the given data.
     * The set* method will be used to set the data.
     *
     * @param array $data
     * @return boolean
     */
    public function populate(array $data = array())
    {
        foreach ($data as $field => $value) {
            $setter = sprintf('set%s', ucfirst(
                str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))
            ));
            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
            }
        }

        return true;
    }

    /**
     * Return a array with all fields and data.
     * Default the relations will be ignored.
     * 
     * @param array $fields
     * @return array
     */
    public function getArrayCopy(array $fields = array())
    {
        $dataFields = array('id', 'SurItem_id', 'SubItem_id', 'amount', 'updated', 'created');
        $relationFields = array('item', 'item');
        $copiedFields = array();
        foreach ($relationFields as $relationField) {
            $map = null;
            if (array_key_exists($relationField, $fields)) {
                $map = $fields[$relationField];
                $fields[] = $relationField;
                unset($fields[$relationField]);
            }
            if (!in_array($relationField, $fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $relationField)))));
            $relationEntity = $this->{$getter}();
            $copiedFields[$relationField] = (!is_null($map))
                ? $relationEntity->getArrayCopy($map)
                : $relationEntity->getArrayCopy();
            $fields = array_diff($fields, array($relationField));
        }
        foreach ($dataFields as $dataField) {
            if (!in_array($dataField, $fields) && !empty($fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $dataField)))));
            $copiedFields[$dataField] = $this->{$getter}();
        }

        return $copiedFields;
    }

    public function __sleep()
    {
        return array('id', 'SurItem_id', 'SubItem_id', 'amount', 'updated', 'created');
    }
}