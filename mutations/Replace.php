<?php

class Replace extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->str(
            str_replace($this->params[0], $this->params[1], $this->value())
        );

        return $this;
    }
}
