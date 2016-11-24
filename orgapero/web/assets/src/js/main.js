$(document).ready(function () {
    $('.button-collapse').sideNav({
            menuWidth: 300,
            edge: 'left', // Choose the horizontal origin
            closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
            draggable: true // Choose whether you can drag to open on touch screens
        }
    );

  $('.partyDatepicker').pickadate({
    selectMonths: true,
    selectYears: 3
  });

  /*$('.partyTimepicker').pickatime({
    interval: 30,
    format: 'h:i A',
    min: [7,30],
    max: [23,59],
    closeOnSelect: true,
    closeOnClear: true,
    onClose: function() {
      console.log('Closed now');
    },
  });*/

  $(document).ready(function() {
    $('select').material_select();
  });
});
