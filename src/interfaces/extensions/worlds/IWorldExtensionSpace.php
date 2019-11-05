<?php
namespace c2b\interfaces\extensions\worlds;

/**
 * Interface IWorldExtensionWater
 *
 * @package c2b\interfaces\extensions\worlds
 * @author jeyroik@gmail.com
 */
interface IWorldExtensionSpace
{
    const RES__NAME = 'space';
    const RES__CHAR_MAX_X = 'x';
    const RES__CHAR_MAX_Y = 'y';
    const RES__CHAR_MAX_Z = 'z';
    const RES__CHAR_VOLUME = 'v';
    const RES__CHAR_ENERGY_BUFFER = 'energy_buffer';

    const RES__PROP__EXPANDING = 'expanding';
    const RES__PROP__EXPANDING__RATIO = 'ratio';
    const RES__PROP__EXPANDING__COST = 'cost';

    const RES__PROP__EXISTING = 'existing';
    const RES__PROP__EXISTING__COST = 'cost';
    const RES__PROP__EXISTING__BUFFER = 'buffer';

    /**
     * @return void
     */
    public function expandSpace();

    /**
     * @return void
     */
    public function drainEnergy();

    /**
     * @return void
     */
    public function bufferSpace();

    /**
     * @return void
     */
    public function degradeSpace();
}
