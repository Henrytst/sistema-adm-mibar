
$(function() {
  scrollItem();

  function scrollItem() {
    $('#menu-principal a, .list-group a').click(function() {
      let ref = '#' + $(this).attr('ref_sys') + '_section';
      let offset = $(ref).offset().top;
      $('html,body').animate({
        'scrollTop': offset - 50
      });
      if ($(window)[0].innerWidth <= 768) {
        $('.icon-bar').click();
      }
    });
  }

  $('button.deletar-membro').click(function() {
    let id_membro = $(this).attr('id_membro');
    let el = $(this).parent().parent();
    $.ajax({
      method: 'post',
      data: {
        'id_membro': id_membro
      },
      url: 'deletar.php'
    }).done(function() {
      el.fadeOut(function() {
        el.remove();
      });
    })
  })
})

$(document).ready(function() {
  function updateDateTime() {
    var currentDate = new Date();
    var dateTimeString = currentDate.toLocaleString();

    // Remover a vírgula após a data
    dateTimeString = dateTimeString.replace(',', '');

    $("#data-hora").text(dateTimeString);
  }

  // Atualizar a data e a hora a cada segundo (1000 milissegundos)
  setInterval(updateDateTime, 1000);
});