<?php

namespace App\Controller\Contact;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class DetailContactController extends AbstractController
{
    /**
     * @Route("contact/detail/{id}", name="detail_contact")
     */
    public function detail(int $id, ContactRepository $contactRepository)
    {
        $contact = $contactRepository->find($id);

        if(!$contact)
        {
            $this->addFlash("danger","Cet contact n'existe pas");
            return $this->redirectToRoute("liste_contact");
        }

        return $this->render("contact/detail.html.twig", [
            'contact' => $contact
        ]);

    }

    }


