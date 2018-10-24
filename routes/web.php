<?php

Route::middleware(['is-authenticated'])->group(function(){

    Route::namespace('Farms')->prefix('farms')->group(function(){
        Route::post('save-ore-mulsori', 'FarmController@saveOreMulsori');
        Route::post('save-user', 'FarmController@saveUser');
    });

    Route::namespace('Animals')->prefix('animals')->group(function(){
        Route::post('crv4-all-import', 'AnimalController@crv4allImport');
        Route::post('get-animal-characteristics', 'AnimalController@getAnimalCharacteristics');
    });

    Route::namespace('System')->prefix('system')->group(function(){
        Route::post('upload-image', 'UploadController@uploadImage')->name('upload-image');
    });

    

});