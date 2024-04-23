<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, Rue>
     */
    #[ORM\OneToMany(targetEntity: Rue::class, mappedBy: 'ville')]
    private Collection $rue;

    /**
     * @var Collection<int, Adresse>
     */
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'ville')]
    private Collection $adresses;

    #[ORM\Column(length: 255)]
    private ?string $relation = null;

    public function __construct()
    {
        $this->rue = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Rue>
     */
    public function getRue(): Collection
    {
        return $this->rue;
    }

    public function addRue(Rue $rue): static
    {
        if (!$this->rue->contains($rue)) {
            $this->rue->add($rue);
            $rue->setVille($this);
        }

        return $this;
    }

    public function removeRue(Rue $rue): static
    {
        if ($this->rue->removeElement($rue)) {
            // set the owning side to null (unless already changed)
            if ($rue->getVille() === $this) {
                $rue->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): static
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setVille($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): static
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getVille() === $this) {
                $adress->setVille(null);
            }
        }

        return $this;
    }

    public function getRelation(): ?string
    {
        return $this->relation;
    }

    public function setRelation(string $relation): static
    {
        $this->relation = $relation;

        return $this;
    }
}
