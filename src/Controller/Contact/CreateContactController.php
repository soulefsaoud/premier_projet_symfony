<?php

namespace App\Controller\Contact;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateContactController extends AbstractController
{

/**
 * @Route("/admin/contact/creer", name= "creer_contact")
 */
 public function create(Request $request, EntityManagerInterface $em): Response 
 {

   
    $contact = new Contact();


    $form = $this->createForm(ContactType::class,$contact);

    
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      //  $data = $form->getData();
      //  dd($data);

       $usr = $this->getUser();

       $contact->setUtilisateur($usr);

        $em->persist($contact); //request comme SQL

        $em->flush();  //execute de SQL

        $this->addFlash('success',' Le contact : ' . $contact->getName() .' , a bien été enregistré');

        return $this->redirectToRoute('creer_contact');


      
    }

    return $this->render("contact/creer.html.twig", [
       'formContact' => $form->createView()
    ]);
 }

}