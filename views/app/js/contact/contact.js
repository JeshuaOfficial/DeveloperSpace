
/**
 * Ajax action to api rest
 * 
 * @param {*} e 
*/
function contact(e){

  /* LOADING */
  var l = Ladda.create( document.querySelector( '#contact' ) );
  l.start();
  /* CLEAR ALL ALERTS */
  toastr.clear();

  e.defaultPrevented;
  $.ajax({
    type : "POST",
    url : "api/contact",
    data : $('#contact_form').serialize(),
    success : function(json) {
      if(json.success == 1) {
        toastr.success(json.message, 'Éxito');
        setTimeout(function(){
            location.reload();
        },1000);
      } else {
        toastr.error(json.message, 'Error');
      }
      l.stop();
    },
    error : function(xhr, status) {
      console.log('Ha ocurrido un problema.');
    }
  });
}

/**
 * Events
 */
$('#contact').click(function(e) {
  contact(e);
});
