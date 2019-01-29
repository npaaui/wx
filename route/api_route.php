<?php
/* Api route */


/**
 * cooking
 */
Route::get('api/cooking/:id', 'Api/Cooking/getCookingOne')->pattern(['id' => '\d+']);
Route::get('api/cooking', 'Api/Cooking/getCookingList');