<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-mappedsuperclass) on 2017-02-25 22:28:05.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErsBase\Entity\Base\ProductPrice
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(name="`product_price`", indexes={@ORM\Index(name="fk_ProductPrice_Product1_idx", columns={"`Product_id`"}), @ORM\Index(name="fk_ProductPrice_Deadline1_idx", columns={"`Deadline_id`"}), @ORM\Index(name="fk_ProductPrice_Counter1_idx", columns={"`Counter_id`"}), @ORM\Index(name="fk_ProductPrice_Currency1_idx", columns={"`Currency_id`"}), @ORM\Index(name="fk_ProductPrice_Agegroup1_idx", columns={"`Agegroup_id`"})})
 * @ORM\HasLifecycleCallbacks
 */
abstract class ProductPrice
{
    /**
     * @ORM\Id
     * @ORM\Column(name="`id`", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`Product_id`", type="integer")
     */
    protected $Product_id;

    /**
     * @ORM\Column(name="`charge`", type="string", length=45, nullable=true)
     */
    protected $charge;

    /**
     * @ORM\Column(name="`Deadline_id`", type="integer", nullable=true)
     */
    protected $Deadline_id;

    /**
     * @ORM\Column(name="`Agegroup_id`", type="integer", nullable=true)
     */
    protected $Agegroup_id;

    /**
     * @ORM\Column(name="`Counter_id`", type="integer", nullable=true)
     */
    protected $Counter_id;

    /**
     * @ORM\Column(name="`Currency_id`", type="integer", nullable=true)
     */
    protected $Currency_id;

    /**
     * @ORM\Column(name="`updated`", type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column(name="`created`", type="datetime")
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productPrices", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="`Product_id`", referencedColumnName="`id`")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="Deadline", inversedBy="productPrices")
     * @ORM\JoinColumn(name="`Deadline_id`", referencedColumnName="`id`", nullable=true)
     */
    protected $deadline;

    /**
     * @ORM\ManyToOne(targetEntity="Agegroup", inversedBy="productPrices")
     * @ORM\JoinColumn(name="`Agegroup_id`", referencedColumnName="`id`", nullable=true)
     */
    protected $agegroup;

    /**
     * @ORM\ManyToOne(targetEntity="Counter", inversedBy="productPrices")
     * @ORM\JoinColumn(name="`Counter_id`", referencedColumnName="`id`", nullable=true)
     */
    protected $counter;

    /**
     * @ORM\ManyToOne(targetEntity="Currency", inversedBy="productPrices")
     * @ORM\JoinColumn(name="`Currency_id`", referencedColumnName="`id`", nullable=true)
     */
    protected $currency;

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
     * @return \ErsBase\Entity\Base\ProductPrice
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
     * Set the value of Product_id.
     *
     * @param integer $Product_id
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setProductId($Product_id)
    {
        $this->Product_id = $Product_id;

        return $this;
    }

    /**
     * Get the value of Product_id.
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->Product_id;
    }

    /**
     * Set the value of charge.
     *
     * @param string $charge
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setCharge($charge)
    {
        $this->charge = $charge;

        return $this;
    }

    /**
     * Get the value of charge.
     *
     * @return string
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * Set the value of Deadline_id.
     *
     * @param integer $Deadline_id
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setDeadlineId($Deadline_id)
    {
        $this->Deadline_id = $Deadline_id;

        return $this;
    }

    /**
     * Get the value of Deadline_id.
     *
     * @return integer
     */
    public function getDeadlineId()
    {
        return $this->Deadline_id;
    }

    /**
     * Set the value of Agegroup_id.
     *
     * @param integer $Agegroup_id
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setAgegroupId($Agegroup_id)
    {
        $this->Agegroup_id = $Agegroup_id;

        return $this;
    }

    /**
     * Get the value of Agegroup_id.
     *
     * @return integer
     */
    public function getAgegroupId()
    {
        return $this->Agegroup_id;
    }

    /**
     * Set the value of Counter_id.
     *
     * @param integer $Counter_id
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setCounterId($Counter_id)
    {
        $this->Counter_id = $Counter_id;

        return $this;
    }

    /**
     * Get the value of Counter_id.
     *
     * @return integer
     */
    public function getCounterId()
    {
        return $this->Counter_id;
    }

    /**
     * Set the value of Currency_id.
     *
     * @param integer $Currency_id
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setCurrencyId($Currency_id)
    {
        $this->Currency_id = $Currency_id;

        return $this;
    }

    /**
     * Get the value of Currency_id.
     *
     * @return integer
     */
    public function getCurrencyId()
    {
        return $this->Currency_id;
    }

    /**
     * Set the value of updated.
     *
     * @param \DateTime $updated
     * @return \ErsBase\Entity\Base\ProductPrice
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
     * @return \ErsBase\Entity\Base\ProductPrice
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
     * Set Product entity (many to one).
     *
     * @param \ErsBase\Entity\Base\Product $product
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get Product entity (many to one).
     *
     * @return \ErsBase\Entity\Base\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set Deadline entity (many to one).
     *
     * @param \ErsBase\Entity\Base\Deadline $deadline
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setDeadline(Deadline $deadline = null)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get Deadline entity (many to one).
     *
     * @return \ErsBase\Entity\Base\Deadline
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set Agegroup entity (many to one).
     *
     * @param \ErsBase\Entity\Base\Agegroup $agegroup
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setAgegroup(Agegroup $agegroup = null)
    {
        $this->agegroup = $agegroup;

        return $this;
    }

    /**
     * Get Agegroup entity (many to one).
     *
     * @return \ErsBase\Entity\Base\Agegroup
     */
    public function getAgegroup()
    {
        return $this->agegroup;
    }

    /**
     * Set Counter entity (many to one).
     *
     * @param \ErsBase\Entity\Base\Counter $counter
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setCounter(Counter $counter = null)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get Counter entity (many to one).
     *
     * @return \ErsBase\Entity\Base\Counter
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * Set Currency entity (many to one).
     *
     * @param \ErsBase\Entity\Base\Currency $currency
     * @return \ErsBase\Entity\Base\ProductPrice
     */
    public function setCurrency(Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get Currency entity (many to one).
     *
     * @return \ErsBase\Entity\Base\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
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
        $dataFields = array('id', 'Product_id', 'charge', 'Deadline_id', 'Agegroup_id', 'Counter_id', 'Currency_id', 'updated', 'created');
        $relationFields = array('product', 'deadline', 'counter', 'currency', 'agegroup');
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
        return array('id', 'Product_id', 'charge', 'Deadline_id', 'Agegroup_id', 'Counter_id', 'Currency_id', 'updated', 'created');
    }
}