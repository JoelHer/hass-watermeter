<?php
require __DIR__ . '/../vendor/autoload.php';
require '../src/config/config.php';

use thiagoalessio\TesseractOCR\TesseractOCR;
use nohn\AnalogMeterReader\AnalogMeter;
use nohn\Watermeter\Watermeter;

$watermeter = new Watermeter();
$lastValue = $watermeter->getCachedValue();

$lastValueTimestamp = filemtime('../src/config/lastValue.txt');
$lastPreDecimalPlaces = (int)$lastValue;

if (isset($_GET['debug'])) {
    $fullDebug = true;
} else {
    $fullDebug = false;
}

$now = time();

$strokeColor = new ImagickPixel('white');
$strokeOpacity = 0.7;

try {
    $digitalSourceImage = new Imagick($config['sourceImage']);
    $sourceImageDebug = clone $digitalSourceImage;
    $targetImage = new Imagick();

    foreach ($config['digitalDigits'] as $digit) {
        $rawDigit = clone $digitalSourceImage;
        $rawDigit->cropImage($digit['width'], $digit['height'], $digit['x'], $digit['y']);
        $targetImage->addImage($rawDigit);
        if ($fullDebug) {
            $draw = new ImagickDraw();
            $draw->setStrokeColor($strokeColor);
            $draw->setStrokeOpacity($strokeOpacity);
            $draw->setStrokeWidth(1);
            $draw->setFillOpacity(0);
            $draw->rectangle($digit['x'], $digit['y'], $digit['x'] + $digit['width'], $digit['y'] + $digit['height']);
            $sourceImageDebug->drawImage($draw);
        }
    }
    $targetImage->resetIterator();
    $numberDigitalImage = $targetImage->appendImages(false);
    if (!isset($config['postprocessing']) || (isset($config['postprocessing']) && $config['postprocessing'])) {
        $numberDigitalImage->enhanceImage();
        $numberDigitalImage->equalizeImage();
    }
    $numberDigitalImage->setImageFormat("png");
    $numberDigitalImage->borderImage('white', 10, 10);

    $hasErrors = false;
    $errors = array();

    $ocr = new TesseractOCR();
    $ocr->imageData($numberDigitalImage, sizeof($numberDigitalImage));
    $ocr->allowlist(range('0', '9'));
    $numberOCR = $ocr->run();
    $numberDigital = preg_replace('/\s+/', '', $numberOCR);
    // There is TesseractOCR::digits(), but sometimes this will not convert a letter do a similar looking digit but completly ignore it. So we replace o with 0, I with 1 etc.
    $numberDigital = strtr($numberDigital, 'oOiIlzZsSBg', '00111225589');
    // $numberDigital = '00815';
    if ($fullDebug) {
        $numberDigitalImage->writeImage('tmp/digital.jpg');
        echo "Raw OCR: $numberOCR<br>";
        echo "Clean OCR: $numberDigital";
        echo '<img alt="Digital Preview" src="tmp/digital.jpg" /><br>';
    }

    if (is_numeric($numberDigital)) {
        $preDecimalPlaces = (int)$numberDigital;
    } else {
        $preDecimalPlaces = $lastPreDecimalPlaces;
        if ($fullDebug) {
            echo 'Choosing last value ' . $lastPreDecimalPlaces . '<br>';
        }
        $errors[__LINE__] = 'Could not interpret ' . $numberDigital . '. Using last known value ' . $lastPreDecimalPlaces;
    }
    $decimalPlaces = '';
    if ($fullDebug) {
        echo "Digital: $preDecimalPlaces<br>";
        echo '<table border="1"><tr>';
        echo '<td>';
        $digitalSourceImage->writeImage('tmp/input.jpg');
        $numberDigitalImage->writeImage('tmp/digital.png');
        echo '</td>';
    }

    $logGaugeImages = array();

    foreach ($config['analogGauges'] as $gaugeKey => $gauge) {
        if ($fullDebug) {
            echo '<td>';
            $draw = new ImagickDraw();
            $draw->setStrokeColor($strokeColor);
            $draw->setStrokeOpacity($strokeOpacity);
            $draw->setStrokeWidth(1);
            $draw->setFillOpacity(0);
            $draw->rectangle($gauge['x'], $gauge['y'], $gauge['x'] + $gauge['width'], $gauge['y'] + $gauge['height']);
            $draw->line($gauge['x'], $gauge['y'], $gauge['x'] + $gauge['width'], $gauge['y'] + $gauge['height']);
            $draw->line($gauge['x'], $gauge['y'] + $gauge['height'], $gauge['x'] + $gauge['width'], $gauge['y']);
            $sourceImageDebug->drawImage($draw);
        }
        $rawGaugeImage = new Imagick($config['sourceImage']);
        $rawGaugeImage->cropImage($gauge['width'], $gauge['height'], $gauge['x'], $gauge['y']);
        $rawGaugeImage->setImagePage(0, 0, 0, 0);
        if (isset($config['logging']) && $config['logging']) {
            $logGaugeImages[] = $rawGaugeImage;
        }
        $amr = new AnalogMeter($rawGaugeImage, 'r');
        $decimalPlaces .= $amr->getValue();
        if ($fullDebug) {
            echo $amr->getValue($fullDebug) . '<br>';
            echo '<img src="tmp/analog_' . $gaugeKey . '.png" /><br />';
            $debugData = $amr->getDebugData();
            foreach ($debugData as $significance => $step) {
                echo round($significance, 4) . ': ' . $step['xStep'] . 'x' . $step['yStep'] . ' => ' . $step['number'] . '<br>';
            }
            $debugImage = $amr->getDebugImage();
            $debugImage->setImageFormat('png');
            $debugImage->writeImage('tmp/analog_' . $gaugeKey . '.png');
            echo '</td>';
        }
    }
    if ($fullDebug) {
        echo '<td>';
        $sourceImageDebug->writeImage('tmp/input_debug.jpg');
        echo '<img src="tmp/input_debug.jpg" />';
        echo '</td>';
        echo '</tr></table>';
    }

    $value = $preDecimalPlaces . '.' . $decimalPlaces;

    if (isset($config['logging']) && $config['logging'] && ($lastValue != $value)) {
        $numberDigitalImage->setImageFormat('png');
        $numberDigitalImage->writeImage('tmp/' . $now . '_' . $lastValue . '-' . $value . '_digital.png');
        for ($i = 0; $i < sizeof($logGaugeImages); $i++) {
            $logGaugeImages[$i]->setImageFormat('png');
            $logGaugeImages[$i]->writeImage('tmp/' . $now . '_' . $lastValue . '-' . $value . '_analog_' . ($i + 1) . '_input.png');
        }
    }

    if (
        is_numeric($value) &&
        ($lastValue <= $value) &&
        (($value - $lastValue) < $config['maxThreshold'])
    ) {
    } else {
        $errors[__LINE__] = is_numeric($value);
        $errors[__LINE__] = ($lastValue <= $value);
        $errors[__LINE__][] = ($value - $lastValue < 1);
        $errors[__LINE__][] = $value;
        $errors[__LINE__][] = $lastValue;
        $errors[__LINE__][] = ($value - $lastValue);
        $hasErrors = true;
    }
    $returnData = array();
    if ($hasErrors) {
        $returnData['value'] = $lastValue;
        $returnData['status'] = 'error';
        $returnData['errors'] = $errors;
        $returnData['exception'] = false;
        $returnData['lastUpdated'] = $lastValueTimestamp;
    } else {
        $returnData['value'] = $value;
        $returnData['status'] = 'error';
        $returnData['errors'] = false;
        $returnData['exception'] = false;
        $returnData['lastUpdated'] = $now;
        file_put_contents('../src/config/lastValue.txt', $value);
    }
    if ($fullDebug) {
        echo "hasErrors: $hasErrors\n<br>";
        echo "<pre>";
        var_dump($errors);
        echo "</pre>";
        echo "lastValue: $lastValue\n<br>";
        echo "value: $value\n<br>";
    }
    if (isset($_GET['json'])) {
        header("Content-Type: application/json");
        echo json_encode($returnData);
    } else {
        echo $returnData['value'];
    }
} catch (Exception $e) {
    if (isset($config['logging']) && $config['logging']) {
        file_put_contents('../log/error/' . $now . '_exception.txt', $e->__toString());
    }
    $returnData = array(
        'value' => $lastValue,
        'status' => 'exception',
        'errors' => false,
        'exception' => $e->__toString(),
        'lastUpdated' => $lastValueTimestamp,
    );
    if (isset($_GET['json'])) {
        header("Content-Type: application/json");
        echo json_encode($returnData);
    } else {
        echo $returnData['value'];
    }
}
