<?php

namespace vphe\HealthTracker\Biomarker;

use vphe\HealthTracker\HealthTrackerException;

/**
 * Class BloodPressure
 * @package vphe\HealthTracker\Biomarker
 */
class BloodPressure extends Biomarker
{
    /**
     * @var array
     */
    protected $value = array();

    /**
     * @var string
     */
    protected $mark = 'mm Hg';

    /**
     * @param string $name
     * @param array $value
     * @throws \Exception
     */
    public function __construct($name, $value = array(null, null))
    {
        $this->name = $name;

        if (is_array($value) && count($value) == 2) {
            $this->value = $value;
        } else {
            throw new HealthTrackerException('Object of ' . __CLASS__ . ' awaits $value as an array');
        }
    }

    /**
     * @param $patientId
     * @param $patientAge
     * @param $patientWeight
     */
    public function measureValue($patientId, $patientAge, $patientWeight)
    {
        // getting real data from DB or message broker, but for example it generates value.
        $this->value[0] = round(mt_rand(0, 109) + (0.5 * $patientAge) + (0.1 * $patientWeight));
        $this->value[1] = round($this->value[0] - ($this->value[0] / 3));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name . ': ' . implode('/', $this->value) . ' ' . $this->mark;
    }
}