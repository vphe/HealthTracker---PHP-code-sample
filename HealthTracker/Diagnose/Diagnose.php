<?php

namespace vphe\HealthTracker\Diagnose;

/**
 * Class Diagnose
 * @package vphe\HealthTracker\Diagnose
 */
class Diagnose extends DiagnosePrototype
{

    /**
     * @param array $diagnoseData
     * @return Diagnose $this
     */
    public function addConfiguration($diagnoseData)
    {
        if (is_array($diagnoseData) && !empty($diagnoseData)) {
            $this->name = key($diagnoseData);
            $this->symptoms = $diagnoseData[$this->name];
        }

        return $this;
    }

    /**
     * @param $biomarker
     * @return int|float|array
     */
    public function getSymptomByBiomarker($biomarker)
    {

        $symptoms = $this->getSymptoms();

        if (isset($symptoms[$biomarker]) && !empty($symptoms[$biomarker])) {
            return $symptoms[$biomarker];
        }
    }

    /**
     * Clean Diagnose object values.
     */
    public function __clone()
    {
        unset($this->name, $this->symptoms);
    }

}