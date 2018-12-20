<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

class ContactController extends AbstractController
{
    /**
     * @Route("/contactez-nous", name="contact")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $this->sendEmail($mailer, $contact->toArray(), $contact->getFile());
            return $this->redirectToRoute('contact', ['success' => 1]);
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'success' => (bool)$request->query->get('success', false)
        ]);
    }

    /**
     * @param \Swift_Mailer $mailer
     * @param array $contact
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile|null $attachment
     */
    protected function sendEmail(\Swift_Mailer $mailer, array $contact, UploadedFile $attachment = null)
    {
        try {
            $orig = $target = null;
            $message = (new \Swift_Message('Nouvelle Demande de Contact'))
                ->setFrom('lanfisis@gmail.com')
                ->setTo('lanfisis@gmail.com')
                ->setBody($this->renderView(
                        'emails/contact.html.twig',
                        ['date' => date('d/m/Y'), 'contact' => $contact]
                    ), 'text/html'
                );
            if ($attachment) {
                $fileSystem = new Filesystem();
                $orig = $attachment->getPathname();
                $target = $attachment->getPath() . '/' . $attachment->getClientOriginalName();
                $fileSystem->copy($orig, $target);
                $message->attach(\Swift_Attachment::fromPath($target));
            }
            $mailer->send($message);
            if ($orig && $target) {
                $fileSystem = new Filesystem();
                $fileSystem->remove([$orig, $target]);
            }
        } catch (\Exception $e) {
            var_dump($e);
            exit;
        }
    }
}
