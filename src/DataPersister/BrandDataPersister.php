<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\DataPersister\Exception\EntityRemoveRejectedException;
use App\Entity\Brand;

final class BrandDataPersister implements ContextAwareDataPersisterInterface {

    public function supports($data, array $context = []): bool {
        return $data instanceof Brand;
    }

    public function persist($data, array $context = []) {
        return $data;
    }

    public function remove($data, array $context = []) {
        /** @var Brand $data */
        if ($data->getModels()->count()) {
            throw new EntityRemoveRejectedException("models", $data->getModels()->count());
        }
    }
}
