$(document).ready(function(){
    
	// main tabs

    $('#btn1').click(function(){	
        $("#appointment").show();
        $("#settings").hide();
        $("#logout").hide();
    });

    $('#btn2').click(function(){
        $("#appointment").hide();
        $("#settings").show();
        $("#logout").hide();
    });
    $('#btn3').click(function(){
        $("#appointment").hide();
        $("#settings").hide();
        $("#logout").show();
    });

    // edit profile tabs

    $('#btn4').click(function(){

		$("#btn4").css("transform","translateY(3px)");
		$("#btn4").css("background-color","white");
		$("#btn4").css("border","1px solid grey");
		$("#btn4").css("border-bottom","none");

		$("#btn5").css("transform","translateY(0px)");
		$("#btn5").css("background-color","#ececec");
		$("#btn5").css("border","none");

        $("#btn6").css("transform","translateY(0px)");
        $("#btn6").css("background-color","#ececec");
        $("#btn6").css("border","none");


        $("#personal-info").show();
        $("#career-info").hide();
        $("#password").hide();
    });

    $('#btn6').click(function(){

        $("#btn6").css("transform","translateY(3px)");
        $("#btn6").css("background-color","white");
        $("#btn6").css("border","1px solid grey");
        $("#btn6").css("border-bottom","none");

        $("#btn4").css("transform","translateY(0px)");
        $("#btn4").css("background-color","#ececec");
        $("#btn4").css("border","none");

        $("#btn5").css("transform","translateY(0px)");
        $("#btn5").css("background-color","#ececec");
        $("#btn5").css("border","none");


        $("#personal-info").hide();
        $("#career-info").show();
        $("#password").hide();
    });

    $('#btn5').click(function(){

		$("#btn5").css("transform","translateY(3px)");
		$("#btn5").css("background-color","white");
		$("#btn5").css("border","1px solid grey");
		$("#btn5").css("border-bottom","none");

		$("#btn4").css("transform","translateY(0px)");
		$("#btn4").css("background-color","#ececec");
		$("#btn4").css("border","none");

        $("#btn6").css("transform","translateY(0px)");
        $("#btn6").css("background-color","#ececec");
        $("#btn6").css("border","none");

        $("#personal-info").hide();
        $("#career-info").hide();
        $("#password").show();
    });

});