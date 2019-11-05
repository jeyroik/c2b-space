<?php
namespace c2b\interfaces\extensions\resources;

/**
 * Interface IResourceSpaceExtension
 *
 * @package c2b\interfaces\extensions\resources
 * @author jeyroik@gmail.com
 */
interface IResourceSpaceExtension
{
    /**
     * @param int $increment
     *
     * @return void
     */
    public function incSpaceBuffer(int $increment);

    /**
     * @param int $decrement
     *
     * @return void
     */
    public function decSpaceBuffer(int $decrement);

    /**
     * @param string $dirName
     * @param int $ratio
     *
     * @return void
     */
    public function expandSpaceDir(string $dirName, int $ratio);

    /**
     * @return int
     */
    public function getVolume(): int;

    /**
     * @param int $volume
     *
     * @return void
     */
    public function setVolume(int $volume);

    /**
     * @return int
     */
    public function getBufferSize(): int;

    /**
     * @return int
     */
    public function getBufferIncrement(): int;

    /**
     * @return int
     */
    public function getExpandCost(): int;

    /**
     * @return int
     */
    public function getExpandRation(): int;

    /**
     * @return int
     */
    public function getX(): int;

    /**
     * @return int
     */
    public function getY(): int;

    /**
     * @return int
     */
    public function getZ(): int;
}
