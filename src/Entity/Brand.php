<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ApiResource]
class Brand
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Model::class, orphanRemoval: true)]
    private $models;

    #[ORM\ManyToMany(targetEntity: SegmentGroup::class, inversedBy: 'brands')]
    private $segmentGroups;

    public function __construct()
    {
        $this->models = new ArrayCollection();
        $this->segmentGroups = new ArrayCollection();
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
     * @return Collection|Model[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SegmentGroup[]
     */
    public function getSegmentGroups(): Collection
    {
        return $this->segmentGroups;
    }

    public function addSegmentGroup(SegmentGroup $segmentGroup): self
    {
        if (!$this->segmentGroups->contains($segmentGroup)) {
            $this->segmentGroups[] = $segmentGroup;
        }

        return $this;
    }

    public function removeSegmentGroup(SegmentGroup $segmentGroup): self
    {
        $this->segmentGroups->removeElement($segmentGroup);

        return $this;
    }
}
