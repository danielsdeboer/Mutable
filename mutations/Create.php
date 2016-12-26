<?php

class Create extends MutationBase {

    /**
     * Perform the mutation
     * @param
     * @return mixed
     */
    public function run()
    {
        $this->out = $this->params[0];

        return $this;
    }
}