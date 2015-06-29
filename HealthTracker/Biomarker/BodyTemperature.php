<?php

namespace vphe\HealthTracker\Biomarker;

use vphe\HealthTracker\HealthTrackerException;

class BodyTemperature extends Biomarker
{
    /**
     * @param string $name
     * @param array|int $value
     * @param string $mark
     * @throws \Exception
     */
    public function __construct($name, $value, $mark)
    {
        parent::__construct($name, $value);
        $this->mark = $mark;
    }

    /**
     * @param $patientId
     * @param $patientAge
     * @param $patientWeight
     */
    public function measureValue($patientId, $patientAge, $patientWeight)
    {
        // getting real data from DB or message broker, but for example it generates value.
        $this->value = round((31.5 + mt_rand() / mt_getrandmax() * (44.5 - 31.5)), 1);

        if ($this->mark == 'F') {
            $this->value = (($this->value * 9) / 5) + 32;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name . ': ' . $this->value . ' °' . $this->mark;
    }
}