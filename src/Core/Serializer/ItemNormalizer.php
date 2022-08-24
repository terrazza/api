<?php
namespace App\Core\Serializer;
use ApiPlatform\Core\Exception\InvalidArgumentException;
use ApiPlatform\Core\Exception\ItemNotFoundException;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use ApiPlatform\Core\Serializer\ItemNormalizer as CoreItemNormalizer;
use Throwable;

class ItemNormalizer extends CoreItemNormalizer {
    /**
     * Denormalizes a relation.
     *
     * @param mixed $value
     *
     * @throws LogicException
     * @throws UnexpectedValueException
     * @throws ItemNotFoundException
     * @throws Throwable
     *
     * @return object|null
     */
    protected function denormalizeRelation(string $attributeName, PropertyMetadata $propertyMetadata, string $className, $value, ?string $format, array $context) {
        try {
            return parent::denormalizeRelation($attributeName, $propertyMetadata, $className, $value, $format, $context);
        }
        catch (Throwable $e) {
            if ($previous = $e->getPrevious()) {
                switch (true) {
                    case $previous instanceof ItemNotFoundException:
                        $e = new $e(sprintf('%s: reference %s does not exists', $attributeName, $value), $e->getCode(), $e->getPrevious());
                        break;
                    case $previous instanceof InvalidArgumentException:
                        $e = new $e(sprintf('%s: %s', $attributeName, $e->getMessage()), $e->getCode(), $e->getPrevious());
                        break;
                }
            }
            throw $e;
        }
    }
}
