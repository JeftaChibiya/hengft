<script src="{{ mix('js/landing.js') }}"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

<script>
    var $j = jQuery.noConflict();

    function accordion() {
        
        // create a jquery prototype called Accordion
        var Accordion = function(item, multiple) {
            this.item = item || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.item.find('.js-accordion-link');
            // Evento
            links.on('click', {item: this.item, multiple: this.multiple}, this.dropdown)
        }

        // append a 'dropdown' effect to the 'Accordion' object
        Accordion.prototype.dropdown = function(e) {
            var $jitem = e.data.item,
                $jthis = $j(this),
                $jnext = $jthis.next();

            $jnext.slideToggle(250);
            $jthis.parent().toggleClass('is-open');

            if (!e.data.multiple) {
                $jitem.find('.js-accordion-submenu').not($jnext).slideUp().parent().removeClass('is-open');
                $jitem.find('.js-accordion-submenu').not($jnext).slideUp();
            };
        }
        var accordion = new Accordion($j('#accordion'), false);
    }
    accordion();        
</script>  


<!-- sideNav -->
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 