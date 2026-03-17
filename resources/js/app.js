import './bootstrap';
import Alpine from 'alpinejs';
import DataTable from 'datatables.net-bs4';

window.Alpine = Alpine;
Alpine.start();

window.DataTable = DataTable;

$(document).on('click', '.noti-box', function() {
	$(this).addClass('tw-hidden');
});
