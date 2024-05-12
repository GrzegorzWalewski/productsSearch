<?php

namespace Tests\Unit;

use Database\Factories\VariantFactory;
use PHPUnit\Framework\TestCase;
use App\Models\PackageType;

class PackageTypeTest extends TestCase
{
    public function testCalcUnitM_AllPositiveIntegers(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 30,
            'width' => 20,
            'height' => 10
        ]);
        $result = PackageType::calcUnitM($variant);

        $this->assertEquals(0.03, $result);
    }

    public function testCalcUnitM_AllFloats(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 10.5,
            'width' => 20.75,
            'height' => 30.25
        ]);
        $result = PackageType::calcUnitM($variant);

        $this->assertEquals(0.03025, $result);
    }

    public function testCalcUnitM_AnyDimensionZero(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 0,
            'width' => 20,
            'height' => 30
        ]);
        $result = PackageType::calcUnitM($variant);

        $this->assertEquals(0.03, $result);
    }

    public function testCalcUnitM2_AllPositiveIntegers(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 3000,
            'width' => 2000
        ]);
        $result = PackageType::calcUnitM2($variant);

        $this->assertEquals(6, $result);
    }

    public function testCalcUnitM2_AllZeros(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 0,
            'width' => 0
        ]);
        $result = PackageType::calcUnitM2($variant);

        $this->assertEquals(0, $result);
    }

    public function testCalcUnitM3_AllPositiveIntegers(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 3000,
            'width' => 2000,
            'height' => 1000
        ]);

        $result = PackageType::calcUnitM3($variant);

        $this->assertEquals(6, $result);
    }

    public function testCalcUnitM3_ThicknessInsteadOfHeight(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 3000,
            'width' => 2000,
            'thickness' => 1000
        ]);
        $result = PackageType::calcUnitM3($variant);

        $this->assertEquals(6, $result);
    }

    public function testCalcUnitM3_AnyZero(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 0,
            'width' => 0,
            'height' => 0
        ]);
        $result = PackageType::calcUnitM3($variant);

        $this->assertEquals(0, $result);
    }

    public function testCalcUnitM3_ThicknessAndHeightEqual(): void
    {
        $variant = VariantFactory::new()->make([
            'length' => 3000,
            'width' => 2000,
            'height' => 1000,
            'thickness' => 1000
        ]);
        $result = PackageType::calcUnitM3($variant);

        $this->assertEquals(6, $result);
    }

    /**
     * @dataProvider getLimitDataProvider
     */
    public function testGetLimit(array $data, float $expected): void
    {
        $result = PackageType::getLimit($data[0], $data[1]);

        $this->assertEquals($expected, $result);
    }

    public function testGetLimit_InvalidPackageType(): void
    {
        $this->expectException(\Exception::class);

        PackageType::getLimit('invalid', null);
    }

    public static function getLimitDataProvider(): array
    {
        return [
            [[PackageType::UNIT_PALLET, null], 1],
            [[PackageType::UNIT_PACKAGE, null], 1],
            [[PackageType::UNIT_PIECE, null], 1],
            [[PackageType::UNIT_ROLL, null], 1],
            [[PackageType::UNIT_BOX, null], 1],
            [
                [
                    PackageType::UNIT_M, VariantFactory::new()->make([
                        'length' => 10,
                        'width' => 20,
                        'height' => 30
                    ])
                ],
                0.03
            ],
            [
                [
                    PackageType::UNIT_M2, VariantFactory::new()->make([
                        'length' => 1000,
                        'width' => 2000
                    ])
                ],
                2
            ],
            [
                [
                    PackageType::UNIT_M3, VariantFactory::new()->make([
                        'length' => 1000,
                        'width' => 2000,
                        'height' => 3000
                    ])
                ],
                6
            ]
        ];
    }
}