/**
 * @author PV3C47FN


/*Fait apparaitre text si clic sur h1 =>paraText*/
$(document).ready(function(){ 
    /*Initialise la boite de dialogue sur pas d'ouverture au chargement de la page
     $( "#dialog" ).dialog({
        autoOpen: false
    });
   /*Fait apparaitre le paragraphe*/
    $('.paraText').show('slow');
    $('.card-content>p').show(1500);
    $('h3').click(function(e){
        $('.paraText').toggle('slow');
    });
});

  $( function() {
    $( "#menu" ).menu();
  } );
  

/*Définit la Boite de dialogue*/
  $( function() {
      //result=false;
    $("#dialog").dialog({autoOpen: false});
    $( "#dialog" ).dialog({ //options de la boite dialog       
        title:"un titre", resizable:false, modal:true,              
              hide: {
                effect: "drop",
                direction:"down",
                duration: 1000
              },
               buttons:[//Fermeture par ok
                { text:"ok",
                    click:function(){
                    $(this).dialog("close");
                    return false; 
                    //return result;   
                    }
                }]
    });
    $( "#opener" ).button();   //Ouverture de la boite #dialog 
    $( "#opener" ).click(function( event ) {     
        $("#dialog").dialog("open");
    });  
  });
  
$(function() {  
    $( '.dropdown' ).click( function( e ) {
        var _this = $( this );
        e.preventDefault();
        _this.toggleClass( 'toggle-on' );
        _this.parent().next( '.sub-menu' ).toggleClass( 'toggled-on' );
        _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
        //_this.html( _this.html() === '<span class="screen-reader-text">Expand child menu</span>' ? '<span class="screen-reader-text">Collapse child menu</span>' : '<span class="screen-reader-text">Expand child menu</span>' );
    } );

});

$(function() {  
    $('a.right-toggle').click(function() {
    	if(!$('.sidebar1').hasClass('right-toggle')) {
    	    $('.sidebar1').addClass('right-toggle');}
	});
	$('a.left-toggle').click(function() {
        if($('.sidebar1').hasClass('right-toggle')) {
            $('.sidebar1').removeClass('right-toggle');}
    });
    $('a.nosidebar-toggle').click(function(){
        $('.master').toggleClass('nosidebar');   
    });
    $('a.hide-toggle').click(function(){
        $('.sidebar1').toggleClass('hide');
        if($('.sidebar1').hasClass('hide')) {
            $('#menuOff').text('Menu On');
            }else{
            $('#menuOff').text('Menu Off');                    
            };
    });
});

$( function() {
    $( "#sortable" ).disableSelection();
    $( "#sortable" ).sortable({
       placeholder:"fantom",
       update:function(event,ui){
           var list = ui.item.parent('ul');
           var cpte=$(list).length;
           console.log (cpte);
           var pos=0;
           $(list.find("li")).each(function() {
             pos--;
             console.log (pos);
             $(this).find("input.positionInput").val(pos);
           });
       }
   });
   
});








