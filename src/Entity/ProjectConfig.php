<?php

namespace App\Entity;

use App\Repository\ProjectConfigRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProjectConfigRepository::class)]
#[Vich\Uploadable]
class ProjectConfig
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Vich\UploadableField(mapping: 'logo_project', fileNameProperty: 'photo')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column]
    private ?DateTimeImmutable $created_at = null;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column]
    private ?DateTimeImmutable $updated_at = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $shorttext = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }


    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }


    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getShorttext(): ?string
    {
        return $this->shorttext;
    }

    public function setShorttext(string $shorttext): static
    {
        $this->shorttext = $shorttext;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile instanceof \Symfony\Component\HttpFoundation\File\File) {
            $this->updated_at = new DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

}
