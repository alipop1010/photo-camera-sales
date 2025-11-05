<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customers', name: 'app_customer')]
    public function index(CustomerRepository $customerRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $customerRepository->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')  // Сортировка по ID
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('customer/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}