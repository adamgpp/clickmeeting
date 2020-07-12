<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Dictionary\FileUploadDictionary;


final class FileUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destination', ChoiceType::class, [
                'label' => 'Wybierz miejsce docelowe',
                'required' => false,
                'choices' => array_flip(FileUploadDictionary::DESTINATION_TYPES),
                'placeholder' => '-- wybierz --',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('file', FileType::class, [
                'label' => 'Wybierz plik',
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Image(),
                ],
            ])
            ->add('submit', SubmitType::class);
    }
}
