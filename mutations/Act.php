<?php

class Act extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->unknownType(
            call_user_func($this->params[0], $this->value())
        );

        return $this;
    }
}
