import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

$(document).on('click', '.noti-box', function() {
	$(this).addClass('tw-hidden');
});
