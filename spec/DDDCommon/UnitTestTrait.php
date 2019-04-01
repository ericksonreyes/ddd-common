<?php
/**
 * Created by PhpStorm.
 * User: ericksonreyes
 * Date: 2019-04-01
 * Time: 12:14
 */

namespace spec\DDDCommon;


use Faker\Factory;
use Faker\Generator;

trait UnitTestTrait
{
    /**
     * @var Generator
     */
    protected $seeder;

    /**
     * UnitTestTrait constructor.
     * @param Generator $seeder
     */
    public function __construct()
    {
        $this->seeder = Factory::create();
    }

}