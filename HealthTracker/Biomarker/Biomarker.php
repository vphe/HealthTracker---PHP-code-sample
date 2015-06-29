<?php

namespace vphe\HealthTracker\Biomarker;

abstract class Biomarker implements Measurable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int|array
     */
    protected $value;

    /**
     * @var string
     */
    protected $mark;

    /**
     * @param string $name
     * @param int|array|null $value
     * @param mixed $mark
     */
    public function __construct($name, $value = null, $mark = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Biomarker $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|float|array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int|array $value
     * @return Biomarker $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @param string $mark
     * @return Biomarker $this
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name . ': ' . $this->value . ' ' . $this->mark;
    }

}