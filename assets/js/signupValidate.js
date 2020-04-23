let login = $('form').find('input[class="sign-up-login"]');
let mail = $('form').find('input[class="sign-up-mail"]');

let loginRegExp= /^[a-z0-9_-]{3,16}$/;
let mailRegExp= /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+.+.[a-zA-Z]{2,4}$/;

let islogin = false;
let isEmail = false;

login.change(function(){
    
    if(login.val().match(loginRegExp)==null){
        islogin=false;
        $(".isLogin").empty();
        $(".isLogin").append('Логин должен состоять только из строчных латинских букв, цифр, символов "_" и "-" и быть длинной от 3 до 16 символов.');
    }else{
        islogin=true;
        $(".isLogin").empty();
    }
    
    
})

mail.change(function(){
    if(mail.val().match(mailRegExp)==null){
        isMail=false;
        $(".isMail").empty();
        $(".isMail").append('Некорректный E-mail.');
    }else{
        isMail=true;
        $(".isMail").empty();
    }
})
pass.change(function(){
    if(pass.val().match(passRegExp)==null){
        isPass=false;
        $(".isPass").empty();
        $(".isPass").append('Пароль может содержать любые латинские, цифры, символы "!" "@" "#" "$" "%" "?" "=" "*" "&" , но быть от 8 до 16 символов.');
    }else{
        isPass=true;
        $(".isPass").empty();
    }  
})

passConfirm.change(function(){
    if(pass.val()==passConfirm.val()){
        isPassConf=true;
        $(".isPassConf").empty();
    }else{
        isPassConf=false;
        $(".isPassConf").empty();
        $(".isPassConf").append('Пароли не совпадают.');     
    }
})
$('body').on('click', '.sign-up-submit', function(e){
    e.preventDefault();
    if(islogin && isMail ){
        $(".isNotGood").empty();   
    }else{
        e.preventDefault();
        $(".isNotGood").empty();
        $(".isNotGood").append('Введите корректные данные!');
    }   
    
});
