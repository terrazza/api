<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\DataPersister\Exception\EntityRemoveRejectedException;
use App\Entity\SegmentGroup;
use Doctrine\ORM\EntityManagerInterface;

final class SegmentGroupDataPersister implements ContextAwareDataPersisterInterface {
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool {
        return $data instanceof SegmentGroup;
    }

    public function persist($data, array $context = []) {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = []) {
        /** @var SegmentGroup $data */
        if ($data->getBrands()->count()) {
            throw new EntityRemoveRejectedException("brands", $data->getBrands()->count());
        }
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
