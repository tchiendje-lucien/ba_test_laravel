document.getElementById("Register").addEventListener("submit", function (e) {
    e.preventDefault()

    var erreur
    var NomRegister = document.getElementById("NomRegister")
    var PrenomRegister = document.getElementById("PrenomRegister")
    var EmailRegister = document.getElementById("EmailRegister")
    var PasswordRegister = document.getElementById("PasswordRegister")
    var ConfirPasswordRegister = document.getElementById("ConfirPasswordRegister")
    const EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const PASSWORD_REGEX = /^(?=.*\d).{4,8}$/;

    if (!EMAIL_REGEX.test(EmailRegister)) {
        return res.status(400).json({ 'error': 'email is not valid' });
    }

    if (!PASSWORD_REGEX.test(PasswordRegister)) {
        e.preventDefault()
        document.getElementById('SpanPasswordRegister').innerHTML = "Syntax Error"
        //return res.status(400).json({ 'error': 'password invalid (must length 4 - 8 and include 1 number at least)' });
    }
    if (PasswordRegister != ConfirPasswordRegister) {
        return res.status(400).json({ 'error': 'Bad password' });
    }
})