<?php

namespace LaminasTwig\Twig;

use Twig\Error\Loader;
use Twig\ExistsLoaderInterface;
use Twig\LoaderInterface;

class MapLoader implements \Twig\Loader\LoaderInterface
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
        print_r($this->map);
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
    public function getSource($name):string
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
    public function getCacheKey($name):string
    {
        return $name;
    }

    /**
     * {@inheritDoc}
     */
    public function isFresh($name, $time):bool
    {
        return filemtime($this->map[$name]) <= $time;
    }

    public function getSourceContext($name):\Twig\Source
    {
        $source = $this->map[$name];

        if (!isset($this->map[$name])) {
            throw new \Twig\Error\LoaderError(sprintf('Template "%s" is not defined.', $name));
        }
        //exit('aa');
        return new \Twig\Source($source, $name);
        /*if (!$this->exists($name)) {
            throw new \Twig\Error\Loader(sprintf(
                'Unable to find template "%s" from template map',
                $name
            ));
        }
    
        return new \Twig\Source("", $name, "");*/
    }

}