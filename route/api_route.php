<?php
/* Api route */

/**
 * user
 */
Route::get('api/user', 'Api/User/getUserOne');
Route::post('api/user', 'Api/User/insertUser');
Route::put('api/user', 'Api/User/updateUser');

/**
 * cooking
 */
Route::get('api/cooking/:id', 'Api/Cooking/getCookingOne')->pattern(['id' => '\d+']);
Route::get('api/cooking', 'Api/Cooking/getCookingList');