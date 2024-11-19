<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idProd', type: 'integer')]
    private ?int $idProd = null;

    #[ORM\Column(name: 'nomProd', type: 'string', length: 20, nullable: false)]
    #[Assert\NotBlank(message: "Le nom du produit ne peut pas être vide.")]
    #[Assert\Length(
        max: 20,
        maxMessage: "Le nom du produit ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $nomProd = null;

    #[ORM\Column(name: 'descriptionProd', type: 'string', length: 100, nullable: false)]
    #[Assert\NotBlank(message: "La description du produit ne peut pas être vide.")]
    #[Assert\Length(
        max: 100,
        maxMessage: "La description du produit ne doit pas dépasser {{ limit }} caractères."
    )]
    private ?string $descriptionProd = null;

    #[ORM\Column(name: 'prixProd', type: 'integer', nullable: false)]
    #[Assert\Positive(message: "Le prix doit être supérieur à zéro.")]
    private ?int $prixProd = null;

    #[ORM\Column(name: 'remise', type: 'float', precision: 10, scale: 0, nullable: false)]
    #[Assert\NotBlank(message: "La remise ne peut pas être vide.")]
    #[Assert\Range(
        min: 0,
        max: 100,
        notInRangeMessage: "La remise doit être entre {{ min }} et {{ max }}."
    )]
    private ?float $remise = null;

    #[ORM\Column(name: 'imageProd', type: 'string', length: 155, nullable: false)]
    #[Assert\NotBlank(message: "L'image ne peut pas être vide.")]
    private ?string $imageProd = null;

    #[ORM\ManyToMany(targetEntity: "Panier", mappedBy: "produit")]
    private Collection $panier;

    public function __construct()
    {
        $this->panier = new ArrayCollection();
    }

    public function getIdProd(): ?int
    {
        return $this->idProd;
    }

    public function getNomProd(): ?string
    {
        return $this->nomProd;
    }

    public function setNomProd(?string $nomProd): self
    {
        $this->nomProd = $nomProd;

        return $this;
    }

    public function getDescriptionProd(): ?string
    {
        return $this->descriptionProd;
    }

    public function setDescriptionProd(string $descriptionProd): self
    {
        $this->descriptionProd = $descriptionProd;

        return $this;
    }

    public function getPrixProd(): ?int
    {
        return $this->prixProd;
    }

    public function setPrixProd(int $prixProd): self
    {
        $this->prixProd = $prixProd;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(?float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getImageProd(): ?string
    {
        return $this->imageProd;
    }

    public function setImageProd(string $imageProd): self
    {
        $this->imageProd = $imageProd;

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPanier(): Collection
    {
        return $this->panier;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->panier->contains($panier)) {
            $this->panier->add($panier);
            $panier->addProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->panier->removeElement($panier)) {
            $panier->removeProduit($this);
        }

        return $this;
    }
}
