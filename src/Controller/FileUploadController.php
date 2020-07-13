<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FileUploadType;
use App\Service\FileUploadService;
use App\Dictionary\FileUploadDictionary;
use Throwable;

final class FileUploadController extends AbstractController
{
    private $file_upload_service;

    public function __construct(FileUploadService $file_upload_service)
    {
        $this->file_upload_service = $file_upload_service;
    }

    /**
     * @Route("/", methods={"GET","POST"})
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(FileUploadType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $destination = $form->get('destination')->getData();
                $uploaded_file = $this->file_upload_service->upload(
                    $form->get('file')->getData(),
                    $destination
                );
                if ($destination === FileUploadDictionary::DESTINATION_LOCAL) {
                    return $this->file($uploaded_file);
                }
                // @todo flash message
                return $this->redirect('/');
            } catch (Throwable $e) {
                // @todo flash message
                return $this->redirect('/');
            }
        }
        return $this->render('app/file_upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
