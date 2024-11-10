<?php

namespace App\Entity;

use App\Repository\SmartwatchIntegrationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SmartwatchIntegrationRepository::class)]
class SmartwatchIntegration
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
