<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        $contacts = [
            [
                'icon' => 'fas fa-map-marker-alt',
                'title' => 'Адрес',
                'value' => 'г. Москва, ул. Фотографическая, д. 123',
                'link' => null
            ],
            [
                'icon' => 'fas fa-phone',
                'title' => 'Телефон',
                'value' => '+7 (495) 123-45-67',
                'link' => 'tel:+74951234567'
            ],
            [
                'icon' => 'fas fa-envelope',
                'title' => 'Email',
                'value' => 'info@photocameras.ru',
                'link' => 'mailto:info@photocameras.ru'
            ],
            [
                'icon' => 'fas fa-clock',
                'title' => 'Время работы',
                'value' => 'Пн-Пт: 9:00 - 18:00',
                'link' => null
            ]
        ];

        return $this->render('contact/index.html.twig', [
            'page_title' => 'Контакты',
            'contacts' => $contacts
        ]);
    }
}