<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2018/12/19
 * Time: 09:08
 */

//wx publicSign
Route::get('api/token', 'wxApi/getAccessToken');


//wx miniProgram
Route::get('cooking/list', 'cooking/getCookingList');