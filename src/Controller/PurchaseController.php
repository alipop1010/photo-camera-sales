<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Repository\PurchaseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController
{
    #[Route('/purchases', name: 'app_purchase')]
    public function index(PurchaseRepository $purchaseRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $purchaseRepository->createQueryBuilder('p')
            ->leftJoin('p.customer', 'c')
            ->leftJoin('p.camera', 'cam')
            ->leftJoin('cam.brand', 'b')
            ->addSelect('c', 'cam', 'b')
            ->orderBy('p.id', 'ASC')  // Сортировка по ID
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('purchase/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}