<?php

namespace vphe\HealthTracker\Biomarker;

use vphe\HealthTracker\HealthTrackerException;

/**
 * Class Pulse
 * @package vphe\HealthTracker\Biomarker
 */
class Pulse extends Biomarker
{
    /**
     * @var string
     */
    protected $mark = 'bpm';

    /**
     * @param $patientId
     * @param $patientAge
     * @param $patientWeight
     */
    public function measureValue($patientId, $patientAge, $patientWeight)
    {
        // getting real data from DB or message broker, but for example it generates value.
        $this->value = mt_rand(0, (220 - $patientAge));
    }
}