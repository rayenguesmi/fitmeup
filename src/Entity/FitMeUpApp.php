<?php

namespace App\Entity;

use App\Repository\FitMeUpAppRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FitMeUpAppRepository::class)]
class FitMeUpApp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
