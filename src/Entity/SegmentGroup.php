<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\SegmentGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SegmentGroupRepository::class)]
#[UniqueEntity('name')]
#[ApiResource]
class SegmentGroup {
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[ApiFilter(SearchFilter::class)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2,max: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Brand::class, mappedBy: 'segmentGroups')]
    private $brands;

    #[ORM\ManyToMany(targetEntity: Model::class, mappedBy: 'segmentGroups')]
    private $models;

    public function __construct()
    {
        $this->brands = new ArrayCollection();
        $this->models = new ArrayCollection();
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
     * @return Collection|Brand[]
     */
    public function getBrands(): Collection
    {
        return $this->brands;
    }

    public function addBrand(Brand $brand): self
    {
        if (!$this->brands->contains($brand)) {
            $this->brands[] = $brand;
            $brand->addSegmentGroup($this);
        }

        return $this;
    }

    public function removeBrand(Brand $brand): self
    {
        if ($this->brands->removeElement($brand)) {
            $brand->removeSegmentGroup($this);
        }

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
            $model->addSegmentGroup($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->models->removeElement($model)) {
            $model->removeSegmentGroup($this);
        }

        return $this;
    }
}
