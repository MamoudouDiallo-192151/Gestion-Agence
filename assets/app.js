/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
var $ = require('jquery');
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/app.scss';
import bsCustomFileInput from 'bs-custom-file-input';

// start the Stimulus application
import './bootstrap'
//mes modifications
global.$ = global.jQuery = $;
require('select2');
$('select').select2();
let $contactButton=$('#contactButton')
$contactButton.click(e=>{
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactButton.slideUp();
})
console.log('hello');
bsCustomFileInput.init();