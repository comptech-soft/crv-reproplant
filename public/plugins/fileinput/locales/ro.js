/*!
 * FileInput Romanian Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 * @author Ciprian Voicu <pictoru@autoportret.ro>
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";

    $.fn.fileinputLocales['ro'] = {
        fileSingle: 'fiÈ™ier',
        filePlural: 'fiÈ™iere',
        browseLabel: 'RÄƒsfoieÈ™te &hellip;',
        removeLabel: 'È˜terge',
        removeTitle: 'CurÄƒÈ›Äƒ fiÈ™ierele selectate',
        cancelLabel: 'RenunÈ›Äƒ',
        cancelTitle: 'AnuleazÄƒ Ã®ncÄƒrcarea curentÄƒ',
        uploadLabel: 'ÃŽncarcÄƒ',
        uploadTitle: 'ÃŽncarcÄƒ fiÈ™ierele selectate',
        msgNo: 'Nu',
        msgNoFilesSelected: '',
        msgCancelled: 'Anulat',
        msgPlaceholder: 'Select {files}...',
        msgZoomModalHeading: 'Previzualizare detaliatÄƒ',
        msgFileRequired: 'You must select a file to upload.',
        msgSizeTooSmall: 'File "{name}" (<b>{size} KB</b>) is too small and must be larger than <b>{minSize} KB</b>.',
        msgSizeTooLarge: 'FiÈ™ierul "{name}" (<b>{size} KB</b>) depÄƒÈ™eÈ™te limita maximÄƒ de Ã®ncÄƒrcare de <b>{maxSize} KB</b>.',
        msgFilesTooLess: 'Trebuie sÄƒ selectezi cel puÈ›in <b>{n}</b> {files} pentru a Ã®ncÄƒrca.',
        msgFilesTooMany: 'NumÄƒrul fiÈ™ierelor pentru Ã®ncÄƒrcare <b>({n})</b> depÄƒÈ™eÈ™te limita maximÄƒ de <b>{m}</b>.',
        msgFileNotFound: 'FiÈ™ierul "{name}" nu a fost gÄƒsit!',
        msgFileSecured: 'RestricÈ›ii de securitate previn citirea fiÈ™ierului "{name}".',
        msgFileNotReadable: 'FiÈ™ierul "{name}" nu se poate citi.',
        msgFilePreviewAborted: 'FiÈ™ierului "{name}" nu poate fi previzualizat.',
        msgFilePreviewError: 'A intervenit o eroare Ã®n Ã®ncercarea de citire a fiÈ™ierului "{name}".',
        msgInvalidFileName: 'Invalid or unsupported characters in file name "{name}".',
        msgInvalidFileType: 'Tip de fiÈ™ier incorect pentru "{name}". Sunt suportate doar fiÈ™iere de tipurile "{types}".',
        msgInvalidFileExtension: 'Extensie incorectÄƒ pentru "{name}". Sunt suportate doar extensiile "{extensions}".',
        msgFileTypes: {
            'image': 'image',
            'html': 'HTML',
            'text': 'text',
            'video': 'video',
            'audio': 'audio',
            'flash': 'flash',
            'pdf': 'PDF',
            'object': 'object'
        },
        msgUploadAborted: 'FiÈ™ierul ÃŽncÄƒrcarea a fost Ã®ntrerupt',
        msgUploadThreshold: 'Processing...',
        msgUploadBegin: 'Initializing...',
        msgUploadEnd: 'Done',
        msgUploadEmpty: 'No valid data available for upload.',
        msgUploadError: 'Error',
        msgValidationError: 'Eroare de validare',
        msgLoading: 'Se Ã®ncarcÄƒ fiÈ™ierul {index} din {files} &hellip;',
        msgProgress: 'Se Ã®ncarcÄƒ fiÈ™ierul {index} din {files} - {name} - {percent}% Ã®ncÄƒrcat.',
        msgSelected: '{n} {files} Ã®ncÄƒrcate',
        msgFoldersNotAllowed: 'Se poate doar trÄƒgÃ¢nd fiÈ™ierele! Se renunÈ›Äƒ la {n} dosar(e).',
        msgImageWidthSmall: 'LÄƒÈ›imea de fiÈ™ier de imagine "{name}" trebuie sÄƒ fie de cel puÈ›in {size} px.',
        msgImageHeightSmall: 'ÃŽnÄƒlÈ›imea fiÈ™ier imagine "{name}" trebuie sÄƒ fie de cel puÈ›in {size} px.',
        msgImageWidthLarge: 'LÄƒÈ›imea de fiÈ™ier de imagine "{name}" nu poate depÄƒÈ™i {size} px.',
        msgImageHeightLarge: 'ÃŽnÄƒlÈ›imea fiÈ™ier imagine "{name}" nu poate depÄƒÈ™i {size} px.',
        msgImageResizeError: 'Nu a putut obÈ›ine dimensiunile imaginii pentru a redimensiona.',
        msgImageResizeException: 'Eroare la redimensionarea imaginii.<pre>{errors}</pre>',
        msgAjaxError: 'Something went wrong with the {operation} operation. Please try again later!',
        msgAjaxProgressError: '{operation} failed',
        ajaxOperations: {
            deleteThumb: 'file delete',
            uploadThumb: 'file upload',
            uploadBatch: 'batch file upload',
            uploadExtra: 'form data upload'
        },
        dropZoneTitle: 'Trage fiÈ™ierele aici &hellip;',
        dropZoneClickTitle: '<br>(or click to select {files})',
        fileActionSettings: {
            removeTitle: 'ScoateÈ›i fiÈ™ier',
            uploadTitle: 'Incarca fisier',
            uploadRetryTitle: 'Retry upload',
            downloadTitle: 'Download file',
            zoomTitle: 'Vezi detalii',
            dragTitle: 'Move / Rearrange',
            indicatorNewTitle: 'Nu a Ã®ncÄƒrcat Ã®ncÄƒ',
            indicatorSuccessTitle: 'Ã®ncÄƒrcat',
            indicatorErrorTitle: 'ÃŽncÄƒrcaÈ›i eroare',
            indicatorLoadingTitle: 'Se Ã®ncarcÄƒ ...'
        },
        previewZoomButtonTitles: {
            prev: 'View previous file',
            next: 'View next file',
            toggleheader: 'Toggle header',
            fullscreen: 'Toggle full screen',
            borderless: 'Toggle borderless mode',
            close: 'Close detailed preview'
        }
    };
})(window.jQuery);