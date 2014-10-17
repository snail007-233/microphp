<?php

require_once 'pluginfortest.php';
require_once('simpletest/autorun.php');
require_once('simpletest/browser.php');
/**
 * MicroPHP模型测试案例
 */
/*
 * Copyright 2013 pm.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * MicroPHP
 * Description of test
 * An open source application development framework for PHP 5.2.0 or newer
 *
 * @package		MicroPHP
 * @author		狂奔的蜗牛
 * @email		672308444@163.com
 * @copyright	        Copyright (c) 2013 - 2013, 狂奔的蜗牛, Inc.
 * @link		http://git.oschina.net/snail/microphp
 * @createdtime         2013-11-19 13:47:34
 */

/**
 * Description of test_model
 *
 * @author pm
 */
class Test_model extends UnitTestCase {

    public function setUp() {
        global $system;
        $system['models_file_autoload'] = array('test/SubUserModel', 'UserModel', array('UserModel' => 'user2'));
        MpRouter::setConfig($system);
    }

    public function tearDown() {
        global $default;
        MpRouter::setConfig($default);
    }

    public function testModelLoader() {
        $loader=  MpLoader::instance();
        $this->assertIsA(WoniuModel::instance('UserModel'), 'UserModel');
        $this->assertIsA(WoniuModel::instance('UserModel'), 'UserModel');
        $this->assertIsA(WoniuModel::instance('UserModel')->test(), 'SubUserModel');
        $this->assertIsA(WoniuModel::instance('test/SubUserModel'), 'SubUserModel');
        $this->assertIsA(WoniuModel::instance('test/SubUserModel'), 'SubUserModel');
        $this->assertIsA(WoniuModel::instance('test/SubUserModel')->test(), 'UserModel');
        $this->assertIsA($loader->model->SubUserModel, 'SubUserModel');
        $this->assertIsA($loader->model->UserModel, 'UserModel');
        MpLoader::instance()->model('UserModel', 'user');
        $this->assertReference(MpLoader::instance()->model->user, MpLoader::instance()->model->UserModel);
        $xx=WoniuModel::instance('UserModel');
        $this->assertReference(MpLoader::instance()->model->user,$xx );
        MpLoader::instance()->model('test/SubUserModel', 'subuser');
        $this->assertReference(MpLoader::instance()->model->subuser, MpLoader::instance()->model->SubUserModel);
        $xx=WoniuModel::instance('SubUserModel');
        $this->assertReference(MpLoader::instance()->model->subuser, $xx);
        $this->assertReference(MpLoader::instance()->model->user, MpLoader::instance()->model->user2);
        $browser = new SimpleBrowser();
        $browser->get(getReqURL('?model.mixLoader'));
        $this->assertEqual($browser->getContent(), 'okay');
    }

}
