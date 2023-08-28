window.$ = window.jQuery = require('jquery');
require('./bootstrap');
require('admin-lte');
var dt = require('datatables.net')();
window.$.DataTable = dt;

var moment = require('moment');
  
console.log(moment().format());

require('sweetalert2');

