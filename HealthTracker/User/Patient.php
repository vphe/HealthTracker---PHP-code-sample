<?php

namespace vphe\HealthTracker\User;

use vphe\HealthTracker\Biomarker\Measurable;
use vphe\HealthTracker\Diagnose\Diagnose;

/**
 * Class Patient
 * @package vphe\HealthTracker\User
 */
class Patient extends User
{

    /**
     * @var int
     */
    private $age;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var array
     */
    private $biomarkers = array();

    /**
     * @var array
     */
    private $diagnoses = array();

    /**
     * Patient constructor, added $weight attribute.
     *
     * @param int $id
     * @param string $name
     * @param int $age
     * @param $weight
     */
    public function __construct($id, $name, $age, $weight)
    {
        parent::__construct($id, $name);
        $this->age = $age;
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return array
     */
    public function getBiomarkers()
    {
        return $this->biomarkers;
    }

    /**
     * @return Measurable
     */
    public function getBiomarker($biomarkerClassName)
    {
        if (isset($this->biomarkers[$biomarkerClassName])) {
            return $this->biomarkers[$biomarkerClassName];
        }
    }

    /**
     * @param Measurable $biomarker
     * @return $this
     */
    public function setBiomarker(Measurable $biomarker)
    {
        $this->biomarkers[$biomarker->getName()] = $biomarker;

        return $this;
    }

    /**
     * Measure all biomarkers in object scope.
     *
     * @return $this
     */
    public function measureBiomarkers()
    {
        foreach ($this->biomarkers as $biomarker) {
            if ($biomarker instanceof Measurable) {
                $biomarker->measureValue($this->id, $this->age, $this->weight);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDiagnose()
    {
        return $this->diagnoses;
    }

    /**
     * @param Diagnose $diagnose
     * @return $this
     */
    public function setDiagnose(Diagnose $diagnose)
    {
        $this->diagnoses[] = $diagnose;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Patient ' . $this->name . ' (' . $this->age . ' age, ' . $this->weight . ' kg)'
        . ' has: ' . implode(', ', $this->diagnoses) . ' (' . implode(', ', $this->biomarkers) . ')';
    }
}