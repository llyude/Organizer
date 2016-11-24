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

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoibWFpbi5qcyIsInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgICAkKCcuYnV0dG9uLWNvbGxhcHNlJykuc2lkZU5hdih7XG4gICAgICAgICAgICBtZW51V2lkdGg6IDMwMCxcbiAgICAgICAgICAgIGVkZ2U6ICdsZWZ0JywgLy8gQ2hvb3NlIHRoZSBob3Jpem9udGFsIG9yaWdpblxuICAgICAgICAgICAgY2xvc2VPbkNsaWNrOiB0cnVlLCAvLyBDbG9zZXMgc2lkZS1uYXYgb24gPGE+IGNsaWNrcywgdXNlZnVsIGZvciBBbmd1bGFyL01ldGVvclxuICAgICAgICAgICAgZHJhZ2dhYmxlOiB0cnVlIC8vIENob29zZSB3aGV0aGVyIHlvdSBjYW4gZHJhZyB0byBvcGVuIG9uIHRvdWNoIHNjcmVlbnNcbiAgICAgICAgfVxuICAgICk7XG5cbiAgJCgnLnBhcnR5RGF0ZXBpY2tlcicpLnBpY2thZGF0ZSh7XG4gICAgc2VsZWN0TW9udGhzOiB0cnVlLFxuICAgIHNlbGVjdFllYXJzOiAzXG4gIH0pO1xuXG4gIC8qJCgnLnBhcnR5VGltZXBpY2tlcicpLnBpY2thdGltZSh7XG4gICAgaW50ZXJ2YWw6IDMwLFxuICAgIGZvcm1hdDogJ2g6aSBBJyxcbiAgICBtaW46IFs3LDMwXSxcbiAgICBtYXg6IFsyMyw1OV0sXG4gICAgY2xvc2VPblNlbGVjdDogdHJ1ZSxcbiAgICBjbG9zZU9uQ2xlYXI6IHRydWUsXG4gICAgb25DbG9zZTogZnVuY3Rpb24oKSB7XG4gICAgICBjb25zb2xlLmxvZygnQ2xvc2VkIG5vdycpO1xuICAgIH0sXG4gIH0pOyovXG5cbiAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgJCgnc2VsZWN0JykubWF0ZXJpYWxfc2VsZWN0KCk7XG4gIH0pO1xufSk7XG4iXX0=
