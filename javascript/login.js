function login(){
    var email = $('#inputEmail').val();
    var password = $('#inputPassword').val();

    mail = 'ericka@gmail.com'
    pass = '1234'

    if (mail == email && pass == password){
        window.location.href = 'client/';
    }else{
        $('#error').css('display', 'block');
    }

}