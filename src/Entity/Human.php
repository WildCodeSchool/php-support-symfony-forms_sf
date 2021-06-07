<?php

namespace App\Entity;

use App\Repository\HumanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=HumanRepository::class)
 */
class Human
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=Cat::class, inversedBy="servants")
     */
    private Collection $masters;

    public function __construct()
    {
        $this->masters = new ArrayCollection();
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

    /**
     * @return Collection|Cat[]
     */
    public function getMasters(): Collection
    {
        return $this->masters;
    }

    public function addMaster(Cat $master): self
    {
        if (!$this->masters->contains($master)) {
            $this->masters[] = $master;
        }

        return $this;
    }

    public function removeMaster(Cat $master): self
    {
        $this->masters->removeElement($master);

        return $this;
    }
}
