<?php

class Explode extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->arr(
            explode($this->params[0], $this->value())
        );

        return $this;
    }
}
