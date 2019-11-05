<?php
namespace c2b\components\plugins\worlds\mutations;

use c2b\components\plugins\PluginChoiceAble;
use c2b\interfaces\extensions\worlds\IWorldExtensionSpace as I;
use c2b\components\worlds\characteristics\WorldCharacteristic;
use c2b\components\worlds\properties\WorldProperty;
use c2b\components\worlds\resources\WorldResource;
use c2b\interfaces\worlds\IWorld;
use c2b\interfaces\worlds\resources\IWorldResource;
use extas\interfaces\parameters\IParameter;

/**
 * Class WorldMutationWater
 *
 * Add
 * - resource "water"
 * - prop "water_generation"
 *
 * @stage world.mutation
 * @package c2b\components\plugins\worlds\mutations
 * @author jeyroik@gmail.com
 */
class WorldMutationSpace extends PluginChoiceAble
{
    protected $choice = 10;

    /**
     * @param IWorld $world
     */
    public function __invoke(IWorld &$world)
    {
        $space = $world->getResource(I::RES__NAME);

        if (!$space) {
            $space = new WorldResource([
                IWorldResource::FIELD__NAME => I::RES__NAME
            ]);
            $space->addCharacteristic(new WorldCharacteristic([
                WorldCharacteristic::FIELD__NAME => I::RES__CHAR_MAX_X,
                WorldCharacteristic::FIELD__VALUE => 1
            ]))->addCharacteristic(new WorldCharacteristic([
                WorldCharacteristic::FIELD__NAME => I::RES__CHAR_MAX_Y,
                WorldCharacteristic::FIELD__VALUE => 1
            ]))->addCharacteristic(new WorldCharacteristic([
                WorldCharacteristic::FIELD__NAME => I::RES__CHAR_MAX_Z,
                WorldCharacteristic::FIELD__VALUE => 1
            ]))->addCharacteristic(new WorldCharacteristic([
                WorldCharacteristic::FIELD__NAME => I::RES__CHAR_ENERGY_BUFFER,
                WorldCharacteristic::FIELD__VALUE => 0
            ]))->addCharacteristic(new WorldCharacteristic([
                WorldCharacteristic::FIELD__NAME => I::RES__CHAR_VOLUME,
                WorldCharacteristic::FIELD__VALUE => 1
            ]));
            $space->addProperty(new WorldProperty([
                WorldProperty::FIELD__NAME => I::RES__PROP__EXPANDING,
                WorldProperty::FIELD__PARAMETERS => [
                    [
                        IParameter::FIELD__NAME => I::RES__PROP__EXPANDING__RATIO,
                        IParameter::FIELD__VALUE => 1
                    ],
                    [
                        IParameter::FIELD__NAME => I::RES__PROP__EXPANDING__COST,
                        IParameter::FIELD__VALUE => 1
                    ]
                ]
            ]))->addProperty(new WorldProperty([
                WorldProperty::FIELD__NAME => I::RES__PROP__EXISTING,
                WorldProperty::FIELD__PARAMETERS => [
                    [
                        IParameter::FIELD__NAME => I::RES__PROP__EXISTING__COST,
                        IParameter::FIELD__VALUE => 1
                    ],
                    [
                        IParameter::FIELD__NAME => I::RES__PROP__EXISTING__BUFFER,
                        IParameter::FIELD__VALUE => 1
                    ]
                ]
            ]));
            $world->addResource($space);
        }
    }
}
