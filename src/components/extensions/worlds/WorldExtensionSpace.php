<?php
namespace c2b\components\extensions\worlds;

use c2b\interfaces\extensions\resources\IResourceSpaceExtension;
use c2b\interfaces\extensions\worlds\IWorldExtensionEnergy;
use c2b\interfaces\extensions\worlds\IWorldExtensionSpace;
use c2b\interfaces\worlds\IWorld;
use c2b\interfaces\worlds\resources\IWorldResource;
use extas\components\extensions\Extension;

/**
 * Class WorldExtensionSpace
 *
 * @package c2b\components\extensions\worlds
 * @author jeyroik@gmail.com
 */
class WorldExtensionSpace extends Extension implements IWorldExtensionSpace
{
    /**
     * @param IWorld|null $world
     */
    public function expandSpace(IWorld &$world = null)
    {
        /**
         * @var $space IResourceSpaceExtension|IWorldResource
         */
        $space = $world->getResource(static::RES__NAME);

        $expandCost     = $space->getExpandCost();
        $expandRatio    = $space->getExpandRation();
        $spaceVolume    = $space->getVolume();
        $energyBuffered = $space->getBufferSize();
        $curExpDir      = $this->getExpandCurDir();

        if ($energyBuffered >= $spaceVolume*$expandCost) {
            $space->decSpaceBuffer($spaceVolume*$expandCost);
            $space->expandSpaceDir($curExpDir, $expandRatio);

            $world->addResource($space);
        }
    }

    /**
     * @param IWorld|IWorldExtensionEnergy $world
     */
    public function bufferSpace(IWorld &$world = null)
    {
        /**
         * @var $space IResourceSpaceExtension
         */
        $curEnergy = $world->getCurrentEnergy();
        $space = $world->getResource(static::RES__NAME);
        $bufferInc = $space->getBufferIncrement();

        if ($curEnergy >= $bufferInc) {
            $space->incSpaceBuffer($bufferInc);
            $world->decCurrentEnergy($bufferInc);

            $world->addResource($space);
        }
    }

    /**
     * @param IWorld|IWorldExtensionEnergy $world
     */
    public function drainEnergy(IWorld &$world = null)
    {
        /**
         * @var $space IResourceSpaceExtension
         */
        $space = $world->getResource(static::RES__NAME);
        
        if ($world->getCurrentEnergy() >= $space->getVolume()) {
            $world->decCurrentEnergy($space->getVolume());
        } else {
            $this->degradeSpace($world);
        }
    }

    /**
     * @param IWorld|IWorldExtensionEnergy $world
     */
    public function degradeSpace(IWorld &$world = null)
    {
        /**
         * @var $space IResourceSpaceExtension|IWorldResource
         */
        $space = $world->getResource(static::RES__NAME);

        $expandRatio    = $space->getExpandRation();
        $curExpDir      = $this->getExpandCurDir();

        if ($world->getCurrentEnergy() < $space->getVolume()) {
            $space->expandSpaceDir($curExpDir, -$expandRatio);
        }
        $world->addResource($space);
    }

    /**
     * @return string
     */
    protected function getExpandCurDir(): string
    {
        $expandDirectionMap = [
            static::RES__CHAR_MAX_X,
            static::RES__CHAR_MAX_Y,
            static::RES__CHAR_MAX_Z
        ];

        return $expandDirectionMap[mt_rand(0, count($expandDirectionMap)-1)];
    }
}
