<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class AdminPropertyController extends AbstractController
{
    #[Route('/admin/properties', name: 'admin_property_index')]
    public function index(PropertyRepository $rep): Response
    {
        $propertys = $rep->findAll();
        return $this->render('admin_property/index.html.twig', [
            'properties' => $propertys, 'current_menu' => 'admin'
        ]);
    }
    #[Route('/admin/property/create', name: 'admin_property_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($property);
            $em->flush();
            $this->addFlash('success', 'Bien créer avec success');
            return $this->redirectToRoute('admin_property_index');
        }
        return $this->render('admin_property/create.html.twig', [
            'property' => $property, 'formProperty' => $form->createView()
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_property_edit')]
    public function edit(Property $property, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Bien modifier avec success');
            return $this->redirectToRoute('admin_property_index');
        }
        return $this->render('admin_property/edit.html.twig', [
            'property' => $property, 'formProperty' => $form->createView()
        ]);
    }
    /**
     * Cette methode permet de verifier si le token est valide et supprimer le bien
     *  *@IsGranted("ROLE_ADMIN")
     * */
    #[Route('/admin/{id}/delete', name: 'admin_property_delete')]
    public function delete(Property $property, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get(('_token')))) {
            $em->remove($property);
            $em->flush();
            $this->addFlash('success', 'Bien supprimer avec success');
            //pour verification du token en commentant les autres lignes
            //  return new Response('suppression');
        }


        return $this->redirectToRoute('admin_property_index');
    }
}
