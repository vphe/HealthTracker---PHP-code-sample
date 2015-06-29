<?php

namespace vphe\HealthTracker\Biomarker;

/**
 * Interface Measurable
 * @package vphe\HealthTracker\Biomarker
 */
interface Measurable
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * @return int|float|array
     */
    public function getValue();

    /**
     * @param $value
     * @return int|float|array
     */
    public function setValue($value);

    /**
     * @return string
     */
    public function getMark();

    /**
     * @param $mark
     * @return string
     */
    public function setMark($mark);

    /**
     * @param int $patientId
     * @param int $patientAge
     * @param int|float $patientWeight
     * @return void
     */
    public function measureValue($patientId, $patientAge, $patientWeight);
}