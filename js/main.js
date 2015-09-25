
$(document).ready(function(){


/* Scroll hire me button to contact page */
	$('.hire-me').click(function(){
		    $('html, body').animate({
        		scrollTop: $( $(this).attr('href') ).offset().top
    		}, 500);
    	return false;
	});

    /* For Bootstrap current state on portfolio sorting */

    $('ul.nav-pills li a').click(function (e) {
        $('ul.nav-pills li.active').removeClass('active')
        $(this).parent('li').addClass('active')
    })

/* portfolio mixitup */

	$(window).load(function(){
    var $container = $('.grid-wrapper');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
 
    $('.grid-controls li a').click(function(){
        $('.grid-controls .current').removeClass('current');
        $(this).addClass('current');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
         });
         return false;
    });
});


/* Magnific Popup */
$('.grid-wrapper').magnificPopup({
		  delegate: 'a', 
		  type: 'image',
		  gallery:{
			enabled:true
		  }
		});



/* Sticky menu */
$(".navbar").sticky({topSpacing: 0});


/* Scroll spy and scroll filter */
    $('#main-menu').onePageNav({
        currentClass: "active",
        changeHash: false,
        scrollThreshold: 0.5,
        scrollSpeed: 750,
        filter: "",
        easing: "swing"	
     });

       // Collapse navbar on click
        $('#main-menu').on('click', function(){
            $('.navbar-toggle').click() //bootstrap 3.x
        });

/* Charts*/
    
$('.chart').waypoint(function() {
    $(this).easyPieChart({
    	   barColor: '#3498db',
    	   size: '150',
			easing: 'easeOutBounce',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
	 });
}, {
  triggerOnce: true,
  offset: 'bottom-in-view'
});


/* VEGAS Home Slider */
	
		$.vegas('slideshow', {
			  backgrounds:[
				
				{ src:'img/slider/01.jpg', fade:1000 },
				{ src:'img/slider/02.jpg', fade:1000 },
				{ src:'img/slider/03.jpg', fade:1000 },
				{ src:'img/slider/04.jpg', fade:1000 }
			  ]
			})('overlay', {
			  src:'img/overlays/16.png'
			});
			$( "#vegas-next" ).click(function() {
			  $.vegas('next');
			});
			$( "#vegas-prev" ).click(function() {
			  $.vegas('previous');
		});


/*Contact form */
      $('#contact-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                phoneUS: true
            },
            date: {
                required: true
            },
            message: {
                required: false
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {
            element.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function() { 
            $.ajax({
                url: 'send_mail.php',
                type: 'POST',
                data: $("#contact-form").serialize(),
                beforeSend: function() {
                    $("#message").html("sending...");
                },
                success: function(data) {
                    $("#message").hide();
                    $("#response").html(data);
                }
            });
        $( "#userForm" ).hide();
        // Reset form fields
        $("#contact-form")[0].reset();
        // Reset form validation labels
        $('#contact-form').validate().resetForm();
        $( "#thanks" ).show( "fast" );
        $('html,body').animate({scrollTop: $("#page-contact").offset().top},'slow');}
    });

$(function() {
    function runEffect() {
        $( "#userForm" ).effect( "fade");
        $( "#thanks" ).show( "slow" );
    };
    function showEffect() {
        $( "#thanks" ).hide();
        $( "#userForm" ).effect( "fade");
    };
    $( "#button" ).click(function() {
        runEffect();
    });
    $( "#showForm" ).click(function() {
        showEffect();
    });
});

});