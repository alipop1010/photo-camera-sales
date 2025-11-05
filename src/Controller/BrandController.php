<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    #[Route('/brands', name: 'app_brand')]
    public function index(BrandRepository $brandRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $brandRepository->createQueryBuilder('b')
            ->orderBy('b.id', 'ASC')  // Сортировка по ID
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('brand/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}