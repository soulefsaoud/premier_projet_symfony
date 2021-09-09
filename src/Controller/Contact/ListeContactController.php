<?php



namespace App\Controller\Contact;

use App\Repository\ContactRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeContactController extends AbstractController
{


/**
 * @Route("/contact/liste", name="liste_contact")
 */
public function list(ContactRepository $contactRepository)
{
    $contacts = $contactRepository->findAll();

    return $this->render("contact/list.html.twig", [
        'contacts' => $contacts
    ]);
}
}