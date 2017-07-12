$('#tw').on("change", function() {
    hideAll();
    showSelected($(this).val());
});

function hideAll() {
	$('tr td.hides').each(function(){
    	$(this).hide();
    });
}

$('.modal-trigger').on('click', function() {
  var id = $(this).attr('data-id');
  var tw = $(this).attr('data-count');
  $('#modal-'+id+'-'+tw).modal('open');
});

$('.modal-trigger-reject').on('click', function() {
  var id = $(this).attr('data-id');
  var tw = $(this).attr('data-count');
  $('#modal-reject-'+id+'-'+tw).modal('open');
});

$('.modal-trigger-nr').on('click', function() {
  var id = $(this).attr('data-id');
  var tw = $(this).attr('data-count');
  $('#modal-nr-'+id+'-'+tw).modal('open');
});

$('.modal-trigger-support').on('click', function() {
  var tw = $(this).attr('data-count');
  $('#modal-add-support-'+tw).modal('open');
});

$('.modal-trigger-lesson').on('click', function() {
  var tw = $(this).attr('data-count');
  $('#modal-add-lesson-'+tw).modal('open');
});

$('.modal-trigger-action').on('click', function() {
  var tw = $(this).attr('data-count');
  $('#modal-add-action-'+tw).modal('open');
});

$('.modal-trigger-rejwit').on('click', function() {
  var id = $(this).attr('data-id');
  var tw = $(this).attr('data-count');
  $('#modal-rejwit-'+id+'-'+tw).modal('open');
});

function showSelected(selected) {
  var classes = parseInt(selected);
	$('tr td.'+classes).each(function(){
    $(this).show();
  });
}

$('#periode').on("change", function() {
    hideAllDetail();
    showSelectedDetail($(this).val());
});

function hideAllDetail() {
	$('div.periode-hides').each(function(){
    	$(this).hide();
    });
}

function showSelectedDetail(selected) {
  var classes = parseInt(selected);
	$('div.'+classes).each(function(){
    $(this).show();
  });
}

$(document).ready(function(){
  $('#tw').change();
  $('#periode').change();
  $('.modal').modal();
})