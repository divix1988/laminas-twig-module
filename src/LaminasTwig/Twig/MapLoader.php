<?php

namespace LaminasTwig\Twig;

use Twig\Error\Loader;
use Twig\ExistsLoaderInterface;
use Twig\LoaderInterface;

class MapLoader implements Twig\ExistsLoaderInterface, Twig\LoaderInterface
{
    /**
     * Array of templates to filenames.
     * @var array
     */
    protected $map = array();

    /**
     * Add to the map.
     *
     * @param string $name
     * @param string $path
     * @throws \Twig\Error\Loader
     * @return MapLoader
     */
    public function add($name, $path)
    {
        if ($this->exists($name)) {
            throw new \Twig\Error\Loader(sprintf(
                'Name "%s" already exists in map',
                $name
            ));
        }
        $this->map[$name] = $path;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function exists($name)
    {
        return array_key_exists($name, $this->map);
    }

    /**
     * {@inheritDoc}
     */
    public function getSource($name)
    {
        if (!$this->exists($name)) {
            throw new \Twig\Error\Loader(sprintf(
                'Unable to find template "%s" from template map',
                $name
            ));
        }
        return file_get_contents($this->map[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getCacheKey($name)
    {
        return $name;
    }

    /**
     * {@inheritDoc}
     */
    public function isFresh($name, $time)
    {
        return filemtime($this->map[$name]) <= $time;
    }
}