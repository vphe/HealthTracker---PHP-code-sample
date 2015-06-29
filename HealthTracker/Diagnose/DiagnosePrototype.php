<?php

namespace vphe\HealthTracker\Diagnose;

/**
 * Class DiagnosePrototype
 * @package vphe\HealthTracker\Diagnose
 */
abstract class DiagnosePrototype implements \IteratorAggregate
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $symptoms = array();

    /**
     * @abstract
     * @param array $diagnoseData
     */
    abstract public function addConfiguration($diagnoseData);

    /**
     * @abstract
     * @return void
     */
    abstract public function __clone();

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getSymptoms()
    {
        return $this->symptoms;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->symptoms);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}