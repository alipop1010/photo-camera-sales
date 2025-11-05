<?php

namespace App\Factory;

use App\Entity\Brand;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

final class BrandFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Brand::class;
    }

    protected function defaults(): array
    {
        $brandNames = ['Canon', 'Nikon', 'Sony', 'Fujifilm', 'Panasonic', 'Olympus', 'Leica', 'Hasselblad', 'Pentax', 'Sigma'];
        $countries = ['Япония', 'Германия', 'США', 'Южная Корея', 'Швеция', 'Китай'];
        $cities = ['Токио', 'Осака', 'Мюнхен', 'Нью-Йорк', 'Сеул', 'Стокгольм', 'Пекин', 'Шанхай'];
        
        $descriptions = [
            'Ведущий производитель фототехники с мировым именем',
            'Инновационные решения для профессиональной фотографии',
            'Качественная оптика и надежные камеры',
            'Передовые технологии в цифровой фотографии',
            'Профессиональное оборудование для фотографов',
            'Доступные камеры для начинающих фотографов',
            'Элитная фототехника премиум-класса',
            'Надежные и долговечные фотоаппараты'
        ];

        $selectedBrand = $this->faker()->randomElement($brandNames);
        
        return [
            'name' => $selectedBrand,
            'country' => $this->faker()->randomElement($countries),
            'description' => $this->faker()->randomElement($descriptions),
            'website' => "https://www.{$selectedBrand}.com",
            'logoUrl' => "/images/logos/{$selectedBrand}.png",
            'foundedYear' => $this->faker()->numberBetween(1900, 2000),
            'headquarters' => $this->faker()->randomElement($cities),
            'createdAt' => \DateTimeImmutable::createFromMutable($this->faker()->dateTimeBetween('-5 years', 'now')),
            'updatedAt' => \DateTimeImmutable::createFromMutable($this->faker()->dateTimeBetween('-1 year', 'now')),
        ];
    }
}