import 'bootstrap';
import $ from 'jquery';
import Modal from 'jquery';
import 'jquery-validation';
import 'datatables.net';
import 'datatables.net-bs5';
import Swal from 'sweetalert2';

window.Swal = Swal;
window.$ = $;
window.Modal = Modal;
window.jQuery = $; // เพิ่มบรรทัดนี้เพื่อให้แน่ใจว่า jQuery ถูกกำหนดไว้ใน window
import '../css/app.css';

(function($) {
    "use strict";
    var fullHeight = function() {
        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function() {
            $('.js-fullheight').css('height', $(window).height());
        });
    };
    fullHeight();
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
})(jQuery);
