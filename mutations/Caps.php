<?php

class Caps extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->str(
            strtoupper($this->in->get())
        );

        return $this;
    }
}