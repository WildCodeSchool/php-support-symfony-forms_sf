<?php

namespace App\Entity;

use App\Repository\CatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatRepository::class)
 */
class Cat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $url;

    /**
     * @ORM\ManyToMany(targetEntity=Human::class, mappedBy="masters")
     */
    private Collection $servants;

    public function __construct()
    {
        $this->servants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Human[]
     */
    public function getServants(): Collection
    {
        return $this->servants;
    }

    public function addServant(Human $servant): self
    {
        if (!$this->servants->contains($servant)) {
            $this->servants[] = $servant;
            $servant->addMaster($this);
        }

        return $this;
    }

    public function removeServant(Human $servant): self
    {
        if ($this->servants->removeElement($servant)) {
            $servant->removeMaster($this);
        }

        return $this;
    }
}
