<?php

namespace App\Factory;

use App\Entity\Camera;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

final class CameraFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Camera::class;
    }

    protected function defaults(): array
    {
        $models = [
            'Alpha A7 III', 'EOS R5', 'Z9', 'X-T5', 'Lumix S5', 'OM-1', 'M11', 'X2D 100C',
            'K-3 III', 'fp L', 'EOS R6', 'Z6 II', 'Alpha A7 IV', 'X-T4', 'GH6', 'E-M1 III',
            'SL2-S', '907X', 'K-1 II', 'DP3 Merrill'
        ];
        
        $sensorTypes = ['Полный кадр', 'APS-C', 'Микро 4/3', 'Средний формат'];
        $features = [
            'Стабилизация изображения, Wi-Fi, Bluetooth',
            'Высокая скорость съемки, 4K видео',
            'Погодозащита, два слота для карт памяти',
            'Наклонный дисплей, сенсорный экран',
            'Высокое разрешение, точный автофокус',
            'Компактный корпус, легкий вес',
            'Профессиональная сборка, долгий срок службы'
        ];

        return [
            'model' => $this->faker()->randomElement($models),
            'brand' => BrandFactory::random(),
            'price' => $this->faker()->numberBetween(30000, 300000),
            'megapixels' => $this->faker()->randomElement([24, 30, 36, 42, 45, 50, 61, 100]),
            'sensorType' => $this->faker()->randomElement($sensorTypes),
            'isWeatherSealed' => $this->faker()->boolean(70),
            'releaseYear' => $this->faker()->numberBetween(2018, 2024),
            'features' => $this->faker()->randomElement($features),
            'stockQuantity' => $this->faker()->numberBetween(0, 50),
        ];
    }
}