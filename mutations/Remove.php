<?php

class Remove extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->str(
            str_replace($this->params[0], '', $this->value())
        );

        return $this;
    }
}