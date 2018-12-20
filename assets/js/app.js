/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)

require('../css/noo.css');
require('../css/noo-font.css');
require('../css/bootstrap.scss');
require('../css/app.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
const $ = require('jquery');
require('jquery-parallax.js');
require('bootstrap');

$("#contactform").submit(function(event) {
    var recaptcha = $("#g-recaptcha-response").val();
    if (recaptcha === "") {
        event.preventDefault();
        alert("Veuillez cocher 'Je ne suis pas un robot'");
    }
});

$('.custom-file-input').on('change',function(){
    var fileName = $(this).val();
    fileName = fileName.replace(/^.*\\/, "");
    $(this).next('.custom-file-label').html(fileName);
})


