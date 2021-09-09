<?php

namespace App\Controller\Contact;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SupprimerContactController extends AbstractController
{

/**
 * @Route("/contact/supprimer/{id}", name="supprimer_contact")
 */
public function supprimer(int $id, ContactRepository $contactRepository, EntityManagerInterface $em)
{
    $contact = $contactRepository->find($id);

    if(!$contact)
    {
            $this->addFlash("danger", "cet Contact n'existe pas");
            return $this->redirectToRoute("liste_contact");

    }
    $em->remove($contact);

    $em->flush();

    $this->addFlash("success", "ce contact a bien été supprimé");

    return $this->redirectToRoute("liste_contact");

}


}