//Publication Script
$('#PubButtum').click(function (e) {
    e.preventDefault();
    //alert("bonjour")
    var postData = $('#PubForm').serialize();
    var Description = $('#Description').val()
    var ImageProduct = $('#ImageProduct').val()
    var typepub = $('#typepub').val()
    var prix = $('#prix').val()
    var quartier = $('#quartier').val()
    var ville = $('#ville').val()
    var typeproduits = $('#typeproduits').val()
    var produit = $('#produit').val()


    if (prix != "" && quartier != "" && Description != "" && ImageProduct != "" && typeproduits != "-1" && typepub != "-1" && ville != "-1" && produit != "-1") {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $.ajax({
            type: 'POST',
            url: '/CreateProduct',
            data: postData,
            dataType: 'json',
            success: function (result) {
                alert(result.isSuccess)
                if (result.isSuccess == false && result.SuperError != "") {
                    console.log(result.isSuccess)
                    $('#SuperError').text(result.SuperError)
                } else {
                    window.location.href = '/HomePage'
                }
            }
        })
    } else {
        $('#SuperError').text("Veillez remplir tout les champs !!!")
    }

});

//Gestion des commentaires
$('#SendComment').click(function (e) {
    e.preventDefault();
   // alert("bonjour")
    var postData = $('#FormComment').serialize();

    if ($('#message').val() != "") {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $.ajax({
            type: 'post',
            url: '/SendMessage',
            data: postData,
            dataType: 'json',
            success: function (result) {
                if (result.isSuccess == false) {
                    console.log(result.isSuccess)
                    console.log(result.errorMessage)
                } else {
                    //alert('send')
                    $('#message').text(result.SuperError)
                }
            }
        })
    } else {
        alert ('vide')
    }

});