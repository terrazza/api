<?php
namespace App\DataPersister\Exception;

class EntityRemoveRejectedException extends \LogicException {
    public function __construct(string $relatedModel, int $relatedCount) {
        parent::__construct(sprintf('count of related %s has to be 0, related count: %u', $relatedModel, $relatedCount));
    }
}
