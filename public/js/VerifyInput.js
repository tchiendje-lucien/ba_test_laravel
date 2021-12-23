$(document).ready(function(){
    $('#LoginButtun').on('click', function(e){
        e.preventDefault();
        
        alert ("Bonjour");
    });
});

document.getElementById("LoginForm").addEventListener("submit", function(e){
    e.preventDefault();
    alert ("bonjour");
});