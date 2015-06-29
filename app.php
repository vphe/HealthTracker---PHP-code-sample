<?php
/**
 * Script work demonstration sample.
 * Data samples provided in arrays ($doctor, $diagnoses, $patients) from data_sample.php file.
 *
 * Notice! There is no real data providers for Biomarkers but hardcoded values generation.
 * Run script a few times to see the output.
 */

require_once 'autoload.php';
require_once 'data_samples.php';

use vphe\HealthTracker\User\Doctor;
use vphe\HealthTracker\User\Patient;
use vphe\HealthTracker\Diagnose\Diagnose;
use vphe\HealthTracker\Biomarker\Pulse;
use vphe\HealthTracker\Biomarker\BloodPressure;
use vphe\HealthTracker\Biomarker\BodyTemperature;


$doctor = new Doctor(1, $doctor[0]);

// setting Doctor's specializations (as a Diagnoses).
$diagnosePrototype = new Diagnose();

while ($diagnoseData = array_shift($diagnoses)) {
    $diagnoseObj = clone $diagnosePrototype;
    $doctor->setSpecialization($diagnoseObj->addConfiguration($diagnoseData));
}

// setting Patients data
$patientsList = array();

foreach ($patients as $patientId => $patient) {
    $patientsList[$patientId] = (new Patient($patientId, $patient[0], $patient[1], $patient[2]))
        ->setBiomarker(new Pulse('Pulse'))
        ->setBiomarker(new BloodPressure('BloodPressure'))
        ->setBiomarker(new BodyTemperature('BodyTemperature', 0, 'C')); // change third attr to "F" to get value in Fahrenheit.
}

// Doctor makes report
foreach ($patientsList as $patientId => $patientObj) {
    $doctor->examinePatient($patientObj);
}

// Output
echo implode(PHP_EOL, $doctor->getMedicalReport()) . PHP_EOL;