window.onload = function () {
    if (window.CKEDITOR){
        CKFinder.config( { connectorPath: '/ckfinder/connector' } );
        for (var ckInstance in CKEDITOR.instances){
            CKFinder.setupCKEditor(CKEDITOR.instances[ckInstance]);
        }
    }
}