<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>  
<script src="../ef_dummy/js/uikit.min.js"></script>

<script>   var dropdown = $('.dropdown');
         	$(dropdown).hide();
         	$('.uk-icon-navicon').click(function(){
                $(dropdown).slideToggle(500);
         	});