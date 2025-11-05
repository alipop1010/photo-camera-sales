<?php

namespace App\DataFixtures;

use App\Factory\BrandFactory;
use App\Factory\CameraFactory;
use App\Factory\CustomerFactory;
use App\Factory\PurchaseFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Создаем 300 брендов
        BrandFactory::createMany(300);
        
        // Создаем 300 камер
        CameraFactory::createMany(300);
        
        // Создаем 300 покупателей
        CustomerFactory::createMany(300);
        
        // Создаем 300 покупок
        PurchaseFactory::createMany(300);
    }
}