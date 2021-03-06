<?php

namespace Pagekit\Widget;

class PositionManager implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $assigned = [];

    /**
     * @var array
     */
    protected $registered = [];

    /**
     * Constructor.
     *
     * @param array $assigned
     */
    public function __construct(array $assigned = [])
    {
        $this->assigned = $assigned;
    }

    /**
     * Finds a position by widget id.
     *
     * @param  integer $id
     * @return string
     */
    public function find($id)
    {
        foreach ($this->assigned as $pos => $ids) {
            if (in_array($id, $ids)) {
                return $pos;
            }
        }

        return '';
    }

    /**
     * Assigns widget id to a position.
     *
     * @param  string $position
     * @param  int    $id
     * @return self
     */
    public function assign($position, $id)
    {
        foreach ($this->assigned as $pos => $ids) {
            $this->assigned[$pos] = array_diff($ids, [$id]);
        }

        $this->assigned[$position][] = $id;

        return $this;
    }

    /**
     * Gets assigned widget ids.
     *
     * @param  string $position
     * @return array
     */
    public function assigned($position)
    {
        return isset($this->assigned[$position]) ? $this->assigned[$position] : [];
    }

    /**
     * Registers a position.
     *
     * @param string $name
     * @param string $label
     * @param string $description
     */
    public function register($name, $label, $description = '')
    {
        $assigned = $this->assigned($name);
        $this->registered[$name] = compact('name', 'label', 'description', 'assigned');
    }

    /**
     * Gets the assigned widget ids.
     *
     * @return array
     */
    public function getAssigned()
    {
        return $this->assigned;
    }

    /**
     * Gets the registered positions.
     *
     * @return array
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Implements JsonSerializable interface.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_values($this->registered);
    }
}
