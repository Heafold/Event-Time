<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EventType;
use App\Entity\Event;

class CreateEventController extends AbstractController
{
    #[Route('/event/create', name: 'app_create_event')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $manager = $doctrine->getManager();
            $manager->persist($event);
            $manager->flush();

            $this->addFlash('success', $event->getName().' a été créé.');

            return $this->redirectToRoute('app_event');
        }

        return $this->render('create_event/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
