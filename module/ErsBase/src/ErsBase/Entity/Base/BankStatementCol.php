<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-mappedsuperclass) on 2017-05-05 22:04:45.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErsBase\Entity\Base\BankStatementCol
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(name="`bank_statement_col`", indexes={@ORM\Index(name="fk_bank_statement_col_bank_statement1_idx", columns={"`bank_statement_id`"})})
 * @ORM\HasLifecycleCallbacks
 */
abstract class BankStatementCol
{
    /**
     * @ORM\Id
     * @ORM\Column(name="`id`", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`bank_statement_id`", type="integer")
     */
    protected $bank_statement_id;

    /**
     * @ORM\Column(name="`column`", type="integer", nullable=true)
     */
    protected $column;

    /**
     * @ORM\Column(name="`value`", type="string", length=1500, nullable=true)
     */
    protected $value;

    /**
     * @ORM\Column(name="`updated`", type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column(name="`created`", type="datetime")
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="BankStatement", inversedBy="bankStatementCols", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="`bank_statement_id`", referencedColumnName="`id`")
     */
    protected $bankStatement;

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
     * @return \ErsBase\Entity\Base\BankStatementCol
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
     * Set the value of bank_statement_id.
     *
     * @param integer $bank_statement_id
     * @return \ErsBase\Entity\Base\BankStatementCol
     */
    public function setBankStatementId($bank_statement_id)
    {
        $this->bank_statement_id = $bank_statement_id;

        return $this;
    }

    /**
     * Get the value of bank_statement_id.
     *
     * @return integer
     */
    public function getBankStatementId()
    {
        return $this->bank_statement_id;
    }

    /**
     * Set the value of column.
     *
     * @param integer $column
     * @return \ErsBase\Entity\Base\BankStatementCol
     */
    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Get the value of column.
     *
     * @return integer
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set the value of value.
     *
     * @param string $value
     * @return \ErsBase\Entity\Base\BankStatementCol
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of updated.
     *
     * @param \DateTime $updated
     * @return \ErsBase\Entity\Base\BankStatementCol
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
     * @return \ErsBase\Entity\Base\BankStatementCol
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
     * Set BankStatement entity (many to one).
     *
     * @param \ErsBase\Entity\Base\BankStatement $bankStatement
     * @return \ErsBase\Entity\Base\BankStatementCol
     */
    public function setBankStatement(BankStatement $bankStatement = null)
    {
        $this->bankStatement = $bankStatement;

        return $this;
    }

    /**
     * Get BankStatement entity (many to one).
     *
     * @return \ErsBase\Entity\Base\BankStatement
     */
    public function getBankStatement()
    {
        return $this->bankStatement;
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
        $dataFields = array('id', 'bank_statement_id', 'column', 'value', 'updated', 'created');
        $relationFields = array('bankStatement');
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
        return array('id', 'bank_statement_id', 'column', 'value', 'updated', 'created');
    }
}