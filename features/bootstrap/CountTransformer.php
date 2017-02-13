<?php

trait CountTransformer
{

    /**
     * @Transform :count
     * @Transform :numberOfItems
     */
    public function castCountToInteger($count)
    {
        return intval($count);
    }
}
