<?php

namespace Aviator\Mutable;

use Aviator\Mutable\Mutations\Create;
use Aviator\Mutable\Traits\HandlesUnknownTypes;
use Aviator\Mutable\Types\Null;

class Mutable
{
    use HandlesUnknownTypes;

    /**
     * Any mutations that have their own method to handle
     * special cases
     * @var array
     */
    protected $specialCases = [
        'create' => true,
    ];

    /**
     * The mutations list
     * @var array
     */
    protected $mutations = [];

    /**
     * Create a new instance of a mutable
     * @param string | int | float | array $mutable
     */
    public function __construct($mutable)
    {
        $mutable = $this->unknownType($mutable);

        $this->mutate('create', $mutable);
    }

    /**
     * Static constructor
     * @param  mixed $mutable
     * @return Mutable
     */
    public static function make($mutable)
    {
        return new self($mutable);
    }

    /**
     * Record the mutated state, the mutation name, and the parameter
     * @param  string $method
     * @param  array | null $params
     * @return $this
     */
    protected function mutate($mutation, $params = null)
    {
        // Create is a separate case as there's no initial value
        // to call $this->value() on
        if ($mutation == 'create') {
            $this->specialCaseCreate($params);

            return $this;
        }

        // Generate the FQN
        $mutation = $this->fqn($mutation);

        $this->mutations[] = $mutation::make($this->value(), $params);

        return $this;
    }

    /**
     * Perform the special case of running the Create mutations.
     * This special case exists since the create mutation has nothing
     * to call $this->value on.
     * @param  mixed $params
     * @return $this
     */
    protected function specialCaseCreate($params)
    {
        $this->mutations[] = Create::make(Null::make(null), [$params]);

        return $this;
    }

    /**
     * Generate the fully qualified class name for mutations
     * @param  string $lowercaseClassName
     * @return string
     */
    protected function fqn($lowercaseClassName)
    {
        return '\\Aviator\\Mutable\\Mutations\\' . ucfirst($lowercaseClassName);
    }

    /**
     * Get the last Type
     * @return mixed
     */
    protected function value()
    {
        return end($this->mutations)->get();
    }

    /**
     * Get the last Type's value
     * @return mixed
     */
    public function get()
    {
        $value = end($this->mutations)->get();

        return $value->get();
    }

    /**
     * Return the list of mutations
     * @return array
     */
    public function mutations()
    {
        return $this->mutations;
    }

    /**
     * Redirect calls to protected methods to the mutation
     * returning $this so the __call'ed methods are fluent
     * @param  string $method
     * @param  array $params
     * @return $this
     */
    public function __call($method, $params)
    {
        $this->mutate($method, $params);

        return $this;
    }

    /**
     * Magic getter
     * @param  string $property
     * @return mixed | null
     */
    public function __get($property)
    {
        if ($property == 'value') {
            return $this->value();
        }

        return null;
    }

}