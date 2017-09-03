<?php

namespace Test;

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * 覆盖setUp方法 添加对sql查询监听
     */
    public function setUp()
    {
        parent::setUp();
        DB::listen(function($query){
            $params = $query->bindings;
            $parttern = [];
            foreach($params as $key=>$value){
                $params[$key] = "'".str_replace('\'','\\\'',$value)."'";
                $parttern[] = '/(\?)/';
            }
            print_r(preg_replace($parttern,$params,$query->sql,1).';'.PHP_EOL);
        });
    }
}
