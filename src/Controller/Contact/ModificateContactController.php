<?php

namespace App\Controller\Contact;

use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModificateContactController extends AbstractController
{


    /**
     * @Route("/contact/modificate/{id}", name= "modificate_contact")
     */
    public function modificate(int $id,Request $request, ContactRepository $contactRepository, EntityManagerInterface $em)
    {
       
        $contact = $contactRepository->find($id);

        if(!$contact)
        {
            $this->addFlash("danger","Ce contact n'existe pas");
            return $this->redirectToRoute("liste_contact");
        }

        // $em->refresh($contact);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
          //  $data = $form->getData();
          //  dd($data);
    
           $usr = $this->getUser();
    
           $contact->setUtilisateur($usr);

            $usr->setId($id + 1);
            $usr->setFirstname("First Modified ".$id);
            $usr->setLastname("LAST Modified ".$id);
            $usr->setRole("user");

            $em->persist($usr);

            $em->flush();
    
            // $em->persist($contact); //request comme SQL
    
            $em->flush();  //execute de SQL
    
            $this->addFlash('success',' Le contact : ' . $contact->getName() .' , a bien été modifié');
    
        }
    
        return $this->redirectToRoute("liste_contact");
    

        return $this->render("contact/modificate.html.twig", [
            'contact' => $contact
        ]);

    }


    
 


}