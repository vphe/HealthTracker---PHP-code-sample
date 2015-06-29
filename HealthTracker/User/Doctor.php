<?php

namespace vphe\HealthTracker\User;

use vphe\HealthTracker\Diagnose\Diagnose;

/**
 * Class Doctor
 * @package vphe\HealthTracker\User
 */
class Doctor extends User
{

    /**
     * @var array
     */
    private $specializations = array();

    /**
     * @var array
     */
    private $medicalReport = array();

    /**
     * @param Diagnose $diagnose
     * @return $this
     */
    public function setSpecialization(Diagnose $diagnose)
    {
        $this->specializations[$diagnose->getName()] = $diagnose;

        return $this;
    }

    /**
     * @param $diagnose
     * @return mixed
     */
    public function getSpecialization($diagnose)
    {
        if (isset($this->specializations[$diagnose])) {
            return $this->specializations[$diagnose];
        }
    }

    /**
     * @return array
     */
    public function getMedicalReport()
    {
        return $this->medicalReport;
    }

    /**
     * @param Patient $patient
     * @return Doctor $this
     */
    public function examinePatient(Patient $patient)
    {
        $patient->measureBiomarkers();

        foreach ($this->specializations as $diagnoseName => $diagnose) {
            $this->compareSymptoms($patient, $diagnose);
        }

        return $this;
    }

    /**
     * @param Patient $patient
     * @param Diagnose $diagnose
     */
    public function compareSymptoms(Patient $patient, Diagnose $diagnose)
    {

        $match = array();

        foreach ($diagnose as $symptomBiomarker => $symptomValue) {
            if ($symptomBiomarker == 'BodyTemperature') {
                $patientBiomarkerValue = $patient->getBiomarker($symptomBiomarker)->getValue();

                if (abs($symptomValue[$patient->getBiomarker($symptomBiomarker)->getMark()] - $patientBiomarkerValue) < 3) {
                    $match[] = true;
                }
            }

            if ($symptomBiomarker == 'BloodPressure') {
                $patientBiomarkerValue = $patient->getBiomarker($symptomBiomarker)->getValue()[0];

                if (abs($symptomValue - $patientBiomarkerValue) < 6) {
                    $match[] = true;
                }
            }

            if ($symptomBiomarker == 'Pulse') {
                $patientBiomarkerValue = $patient->getBiomarker($symptomBiomarker)->getValue();

                if ($symptomValue['min'] <= $patientBiomarkerValue && $patientBiomarkerValue <= $symptomValue['max']) {
                    $match[] = true;
                }
            }
        }

        if (array_sum($match) == 3) {
            $this->medicalReport[$patient->getId()] = (string)$patient->setDiagnose($diagnose);
        }
    }
}