<?php

class Caps extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = Str::make(strtoupper($this->in->get()));

        return $this;
    }
}