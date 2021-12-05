function sendMail(){

    $.ajax({
        url: '../apis/sendMail.php',
        data: { to : "jcedeno0741@utm.edu.ec",
                NOMBRE: "JORGE CEDEÑO",
                NOMBRE_RUBRICA: "RUBRICA NUMERO 1",
                DOCENTE: "ING. DIEGO ALAVA"
             },
        success: function (resp) {
          console.log(resp);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("s");
        }
    });
}