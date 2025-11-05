<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\CameraRepository;
use App\Repository\CustomerRepository;
use App\Repository\PurchaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        BrandRepository $brandRepository,
        CameraRepository $cameraRepository, 
        CustomerRepository $customerRepository,
        PurchaseRepository $purchaseRepository
    ): Response
    {
        $stats = [
            'brands' => $brandRepository->count([]),
            'cameras' => $cameraRepository->count([]),
            'customers' => $customerRepository->count([]),
            'purchases' => $purchaseRepository->count([]),
        ];

        // Последние 5 покупок
        $recentPurchases = $purchaseRepository->findBy(
            [],
            ['purchaseDate' => 'DESC'],
            5
        );

        return $this->render('home/index.html.twig', [
            'stats' => $stats,
            'recent_purchases' => $recentPurchases,
        ]);
    }
}