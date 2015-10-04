/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/user/do_upload_video',
        acceptFileTypes: /(\.|\/)(flv|mov|mp4|wmv)$/i,
        // The maximum allowed file size in bytes:
        maxFileSize: 200000000, // 500mb
        // The minimum allowed file size in bytes:
        minFileSize: undefined, // No minimal file size
        // The limit of files to be uploaded:
        maxNumberOfFiles: 1
    });
    $('#fileupload').addClass('fileupload-processing');
    $('#fileupload').fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                    )
            );
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0],
        success: function (data) {
            console.log(data);
        }
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {

        $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
    });

});
