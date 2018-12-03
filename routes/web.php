<?php

Route::middleware(['is-authenticated'])->group(function(){

    Route::namespace('Farms')->prefix('farms')->group(function(){
        Route::post('save-ore-mulsori', 'FarmController@saveOreMulsori');
        Route::post('save-user', 'FarmController@saveUser');
        Route::post('save-cow', 'FarmController@saveCow');
        Route::post('attach-animal', 'FarmController@attachAnimal');
        Route::post('import/sires-upload', 'FarmController@siresUpload');
        Route::post('import/sires-import', 'FarmController@siresImport');
        Route::post('animals/delete-all', 'FarmController@animalsDelete');
        Route::post('animals/download', 'FarmController@animalsDownload');
    });

    Route::namespace('Animals')->prefix('animals')->group(function(){
        Route::post('crv4-all-import', 'AnimalController@crv4allImport');
        Route::post('get-animal-characteristics', 'AnimalController@getAnimalCharacteristics');
    });

    Route::namespace('System')->prefix('system')->group(function(){
        Route::post('upload-image', 'UploadController@uploadImage')->name('upload-image');
        // Route::post('user-preferences-save', 'UserpreferencesController@savePreferences')->name('save-user-preferences');
    });


});