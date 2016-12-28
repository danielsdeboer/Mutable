<?php

class Round extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->flt(
            round($this->value(), isset($this->params[0]) ? $this->params[0] : 2)
        );

        return $this;
    }
}
