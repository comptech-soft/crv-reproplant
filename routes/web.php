<?php

Route::middleware(['is-authenticated'])->group(function(){

    Route::namespace('Farms')->prefix('farms')->group(function(){
        Route::post('save-ore-mulsori', 'FarmController@saveOreMulsori');
        Route::post('save-user', 'FarmController@saveUser');
    });
});