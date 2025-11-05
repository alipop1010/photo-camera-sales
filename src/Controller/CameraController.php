<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Repository\CameraRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CameraController extends AbstractController
{
    #[Route('/cameras', name: 'app_camera')]
    public function index(CameraRepository $cameraRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $cameraRepository->createQueryBuilder('c')
            ->leftJoin('c.brand', 'b')
            ->addSelect('b')
            ->orderBy('c.id', 'ASC')  // Сортировка по ID
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('camera/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}