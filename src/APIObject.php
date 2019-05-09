<?php


namespace MMunoz;


class APIObject
{

    /**
     * @param $data
     */
    public function setData($data) {

        if($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }
}