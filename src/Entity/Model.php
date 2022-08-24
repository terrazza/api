<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ModelRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
#[ApiResource]
class Model {
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[ApiFilter(SearchFilter::class)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4,max: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiFilter(SearchFilter::class)]
    #[Assert\NotBlank]
    private $brand;

    #[ORM\ManyToMany(targetEntity: SegmentGroup::class, inversedBy: 'brands')]
    #[ApiFilter(SearchFilter::class)]
    #[Assert\Count(min: 1)]
    private $segmentGroups;

    public function __construct()
    {
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

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getBrand(): ?Brand {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self {
        $this->brand = $brand;
        return $this;
    }


    /**
     * @return Collection|SegmentGroup[]
     */
    public function getSegmentGroups(): Collection {
        return $this->segmentGroups;
    }

    public function addSegmentGroup(SegmentGroup $segmentGroup): self {
        if (!$this->segmentGroups->contains($segmentGroup)) {
            $this->segmentGroups[] = $segmentGroup;
        }
        return $this;
    }

    public function removeSegmentGroup(SegmentGroup $segmentGroup): self {
        $this->segmentGroups->removeElement($segmentGroup);
        return $this;
    }

    /** - - - V A L I D A T I O N - - - */

    /**
     * @Assert\IsFalse(message="segment_group #{{ value }} is not supported by given brand")
     */
    private function isUnsupportSegmentGroup() {
        foreach ($this->getSegmentGroups() as $segmentGroup) {
            if (!$this->getBrand()->getSegmentGroups()->contains($segmentGroup)) {
                return $segmentGroup->getId();
            }
        }
        return false;
    }

    /**
     * @Assert\IsFalse(message="given name already exists for given brand, #{{ value }}")
     */
    private function isUniqueModelName() {
        if ($this->getBrand()) foreach ($this->getBrand()->getModels() as $model) {
            if ($model->getName() === $this->name && $model->getId() !== $this->id) {
                return $model->getId();
            }
        }
        return false;
    }
}
