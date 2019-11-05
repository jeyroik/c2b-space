<?php
namespace c2b\components\extensions\resources;

use c2b\interfaces\extensions\resources\IResourceSpaceExtension;
use c2b\interfaces\extensions\worlds\IWorldExtensionSpace;
use c2b\interfaces\worlds\resources\IWorldResource;
use extas\components\extensions\Extension;

/**
 * Class ResourceSpaceExtension
 *
 * @package c2b\components\extensions\resources
 * @author jeyroik@gmail.com
 */
class ResourceSpaceExtension extends Extension implements IResourceSpaceExtension
{
    /**
     * @param int $increment
     * @param IWorldResource|null $space
     */
    public function incSpaceBuffer(int $increment, IWorldResource &$space = null)
    {
        $buffer = $space->getCharacteristic(IWorldExtensionSpace::RES__CHAR_ENERGY_BUFFER);
        $buffer->setValue($buffer->getValue(0) + $increment);
        $space->addCharacteristic($buffer);
    }

    /**
     * @param int $decrement
     * @param IWorldResource|null $space
     */
    public function decSpaceBuffer(int $decrement, IWorldResource &$space = null)
    {
        $buffer = $space->getCharacteristic(IWorldExtensionSpace::RES__CHAR_ENERGY_BUFFER);
        $buffer->setValue($buffer->getValue(0) - $decrement);
        $space->addCharacteristic($buffer);
    }

    /**
     * @param string $dirName
     * @param int $ratio
     * @param IWorldResource|null $space
     */
    public function expandSpaceDir(string $dirName, int $ratio, IWorldResource &$space = null)
    {
        $expDir = $space->getCharacteristic($dirName);
        $expDir->setValue($expDir->getValue(0) + $ratio);
        $space->addCharacteristic($expDir);

        $this->setVolume(
            abs($this->getX($space) * $this->getY($space) * $this->getZ($space)),
            $space
        );
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getVolume(IWorldResource $space = null): int
    {
        return $space
            ->getCharacteristic(IWorldExtensionSpace::RES__CHAR_VOLUME)
            ->getValue(0);
    }

    /**
     * @param int $volume
     * @param IWorldResource|null $space
     */
    public function setVolume(int $volume, IWorldResource &$space = null)
    {
        $volume = $space->getCharacteristic(
            IWorldExtensionSpace::RES__CHAR_VOLUME
        );
        $volume->setValue($volume);
        $space->addCharacteristic($volume);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getX(IWorldResource $space = null): int
    {
        return $space
            ->getCharacteristic(IWorldExtensionSpace::RES__CHAR_MAX_X)
            ->getValue(0);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getY(IWorldResource $space = null): int
    {
        return $space
            ->getCharacteristic(IWorldExtensionSpace::RES__CHAR_MAX_Y)
            ->getValue(0);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getZ(IWorldResource $space = null): int
    {
        return $space
            ->getCharacteristic(IWorldExtensionSpace::RES__CHAR_MAX_Z)
            ->getValue(0);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getBufferSize(IWorldResource $space = null): int
    {
        return $space
            ->getCharacteristic(IWorldExtensionSpace::RES__CHAR_ENERGY_BUFFER)
            ->getValue(0);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getExpandCost(IWorldResource $space = null): int
    {
        $expand = $space->getProperty(IWorldExtensionSpace::RES__PROP__EXPANDING);
        return $expand->getParameter(IWorldExtensionSpace::RES__PROP__EXPANDING__COST)->getValue(0);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getExpandRation(IWorldResource $space = null): int
    {
        $expand = $space->getProperty(IWorldExtensionSpace::RES__PROP__EXPANDING);
        return $expand->getParameter(IWorldExtensionSpace::RES__PROP__EXPANDING__RATIO)->getValue(0);
    }

    /**
     * @param IWorldResource|null $space
     *
     * @return int
     */
    public function getBufferIncrement(IWorldResource $space = null): int
    {
        return $space
            ->getProperty(IWorldExtensionSpace::RES__PROP__EXISTING)
            ->getParameter(IWorldExtensionSpace::RES__PROP__EXISTING__BUFFER)
            ->getValue(0);
    }
}
