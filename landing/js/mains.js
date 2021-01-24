$(document).ready(function () {
      var url = $('meta[name="host_url"]').attr('content');

    $('#content2').hide();
    $('#content3').hide();

    $('.btnx').click(function (e) { 
        e.preventDefault();
        $('.box_grid').hide();
        $('button').removeClass('active_nav');
        $(this).addClass('active_nav');
        $('#content'+$(this).attr('formtarget')).show();
    });

    red_login = () => {
    	window.location.href = url+'/login';
    } 

});

