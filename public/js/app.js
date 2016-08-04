$(document).ready(function(){
	$(' body > div.files > ul > li:nth-child(1) > a').click(function(){
		$(this).parent().find('.fileChange').show();
	});

	console.log('click');

	$('[data-toggle="tooltip"]').tooltip()
});
