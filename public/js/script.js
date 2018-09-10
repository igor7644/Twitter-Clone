$(document).ready(function(){

  document.getElementById('hiddenContent').style.display = 'none';

  var buttons = document.getElementsByClassName('hiddenContent2');
  for(var i=0; i<buttons.length; i++)
  {
    buttons[i].style.display = 'none';
  }

  $('.textarea-comment').on('focus', function(){
    var id = $(this).attr("data-id");
    $('#hiddenContent-'+id).fadeIn();
  });
  $('.textarea-comment').on('blur', function(){
    var id = $(this).attr("data-id");
    $('#hiddenContent-'+id).fadeOut();
  });

});

function blurBtn()
{
  if(document.getElementById('textarea-insert').value === '')
  {
    document.getElementById('postBtn').style.opacity = "0.5"; 
  }
  else
  {
    document.getElementById('postBtn').style.opacity = "1"; 
  }
}
// characters remaining
function countChar(val) 
{
  if(document.getElementById('textarea-insert').value === '')
  {
    document.getElementById('postBtn').style.opacity = "0.5"; 
  }
  else
  {
    document.getElementById('postBtn').style.opacity = "1"; 
  }
  var len = val.value.length;

  if (len >= 250) 
  {
    val.value = val.value.substring(0, 250);
    $('.char-num').text('You have reached post limit!');
    $('.char-text').html('');
  } 
  else 
  {
    $('.char-num').text(250 - len);
    var remaining = (250-len);

    if(remaining == 1)
    {
      $('.char-text').html(' character remaining');
    }
    else 
    {
      $('.char-text').html(' characters remaining');
    }
  }
}

//expand and show content
function expand()
{
  $('.textarea-insert').click(function(){
    $('.textarea-insert').css('height','7em');
    $('#hiddenContent').show();
  });
}
//hide content
$(document).on('click',function(e){
  if(e.target.id === 'postBtn')
  {
    $('.textarea-insert').css('height','7em');
  }
  else 
  {
    if(e.target.id === 'textarea-insert')
    {
      $('.textarea-insert').css('height','7em');
    }
    else 
    {
      $('.textarea-insert').css('height','3em');
      $('#hiddenContent').hide();
    }
  }
});








  
