<?php


namespace App\Instagram;


class FakeInstagramClient implements InstagramClient
{
    public function fetch()
    {
        return collect([
            ['src_low' => 'TEST_SRC_LOW', 'src_std' => 'TEST_SRC_STD']
        ]);
    }
}