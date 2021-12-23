jQuery ().ready (function () {
  // validate form on keyup and submit
  var v = jQuery ('#basicform').validate ({
    rules: {
      libelle_site: {
        required: true,
        minlength: 2,
        maxlength: 255,
      },
      capacite_site: {
        required: true,
        minlength: 2,
        maxlength: 255,
      },
      localite_site: {
        required: true,
        minlength: 2,
        maxlength: 255,
      },
      desc_site: {
        required: true,
        minlength: 6,
        maxlength: 1000,
      },
      quartier_site: {
        required: true,
        minlength: 2,
        maxlength: 255,
      },
      desc_exp: {
        required: true,
        minlength: 6,
        maxlength: 1000,
      },
    },
    errorElement: 'span',
    errorClass: 'help-inline-error',
  });

  $ ('.open1').click (function () {
    if (v.form ()) {
      $ ('.frm').hide ('fast');
      $ ('#sf2').show ('slow');
    }
  });

  $ ('.open2').click (function () {
    if (v.form ()) {
      $ ('.frm').hide ('fast');
      $ ('#sf3').show ('slow');
    }
  });

  $ ('.open3').click (function () {
    if (v.form ()) {
      $ ('.frm').hide ('fast');
      $ ('#sf4').show ('slow');
    }
  });

  $ ('.open4').click (function () {
    if (v.form ()) {
      $ ('#loader').show ();
      setTimeout (function () {
        $ ('#basicform').html (
          '<h2>Le formulaire a ete soumit avec success</h2> '
        );
      }, 1000);
      return false;
    }
  });

  $ ('.back2').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf1').show ('slow');
  });

  $ ('.back3').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf2').show ('slow');
  });

  $ ('.back4').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf3').show ('slow');
  });

  $ ('.step1').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf1').show ('slow');
  });

  $ ('.step2').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf2').show ('slow');
  });

  $ ('.step3').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf3').show ('slow');
  });

  $ ('.step4').click (function () {
    $ ('.frm').hide ('fast');
    $ ('#sf4').show ('slow');
  });
});

//
function doAfterSelectImage (input) {
  readURL (input);
}

function readURL (input) {
  if (input.files && input.files[0]) {
    console.log (input.files);
    console.log (input.files[0]);
    var f = $ ('#formData').serialize ();
    console.log (f);
    var form = new FormData ();
    form.append ('ImageUser', $ ('#ImageUser').val ());
    var reader = new FileReader ();
    reader.onload = function (e) {
      $ ('#post_user_image_').attr ('src', e.target.result);
    };
    reader.readAsDataURL (input.files[0]);
  }
}
