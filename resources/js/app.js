import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';
import DataTable from 'datatables.net-dt';

window.Alpine = Alpine;
Alpine.start();

window.$ = window.jQuery = $;
window.DataTable = DataTable;

$(document).on('click', '.noti-box', function() {
	$(this).addClass('tw-hidden');
});
