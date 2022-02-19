<?php

use nohn\Watermeter\Reader;
use PHPUnit\Framework\TestCase;

class WatermeterReaderVariantTest extends TestCase
{
    private $variants = array(
        'regular1' =>
            array(
                'lastValue' => 1189.1668,
                'expectedValue' => 1189.2776,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/1.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular1_with_offset' =>
            array(
                'lastValue' => 1189.1668,
                'expectedValue' => 3189.2776,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'offsetValue' => 2000,
                    'sourceImage' => __DIR__ . '/data/variants/1.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular1_with_negative_offset' =>
            array(
                'lastValue' => 1189.1668,
                'expectedValue' => 189.2776,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'offsetValue' => -1000,
                    'sourceImage' => __DIR__ . '/data/variants/1.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular2' =>
            array(
                'lastValue' => 1189.1668,
                'expectedValue' => 1189.2776,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/2.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular2_with_brightness_contrast' =>
            array(
                'lastValue' => 1189.1668,
                'expectedValue' => 1189.2776,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/2.jpg',
                    'sourceImageBrightness' => '30',
                    'sourceImageContrast' => '50',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular3_with_full_image_processing' =>
            array(
                'lastValue' => 1189.2668,
                'expectedValue' => 1189.3858,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/3.jpg',
                    'sourceImageRotate' => '-3',
                    'sourceImageCropSizeX' => '650',
                    'sourceImageCropSizeY' => '600',
                    'sourceImageCropStartX' => '890',
                    'sourceImageCropStartY' => '1360',
                    'sourceImageBrightness' => '30',
                    'sourceImageContrast' => '50',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular4_with_ocr_passing' =>
            array(
                'lastValue' => 1189.9216,
                'expectedValue' => 1189.9244,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/4.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular5_with_ocr_failing_smaller' =>
            array(
                'lastValue' => 1189.9216,
                'expectedValue' => 1189.9216,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/5.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
        'regular6_with_ocr_failing_larger' =>
            array(
                'lastValue' => 1189.9244,
                'expectedValue' => 1189.9244,
                'config' => array(
                    'maxThreshold' => '0.2',
                    'sourceImage' => __DIR__ . '/data/variants/6.jpg',
                    'digitalDigits' =>
                        array(
                            2 =>
                                array(
                                    'x' => '189',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            3 =>
                                array(
                                    'x' => '249',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            4 =>
                                array(
                                    'x' => '304',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                            5 =>
                                array(
                                    'x' => '364',
                                    'y' => '47',
                                    'width' => '36',
                                    'height' => '58',
                                ),
                        ),
                    'analogGauges' =>
                        array(
                            1 =>
                                array(
                                    'x' => '488',
                                    'y' => '146',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            2 =>
                                array(
                                    'x' => '419',
                                    'y' => '314',
                                    'width' => '148',
                                    'height' => '150',
                                ),
                            3 =>
                                array(
                                    'x' => '250',
                                    'y' => '384',
                                    'width' => '148',
                                    'height' => '155',
                                ),
                            4 =>
                                array(
                                    'x' => '73',
                                    'y' => '310',
                                    'width' => '150',
                                    'height' => '155',
                                ),
                        ),
                    'logging' => false,
                    'postprocessing' => false,
                ),
            ),
    );

    public function testVariants(): void
    {
        foreach ($this->variants as $variant_id => $variant) {
            $reader = new Reader(false, $variant['config'], $variant['lastValue']);
            $this->assertEquals($variant['expectedValue'], $reader->getValue(), 'Variant ' . $variant_id);
        }
    }
}
