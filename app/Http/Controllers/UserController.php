<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create_profile()
    {
        $id_user = session::get('id_user');
        if (!isset($id_user) || empty($id_user)) {
            return redirect('login');
        } else {
            $infos_user = DB::table('users')
                ->where('ID_USER', $id_user)
                ->get();
            return view(
                'auth.user_profile',
                [
                    'infos_user' => $infos_user
                ]
            );
        }
    }

    function verify_input($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    public function update_user_profile(Request $req)
    {
        $id_user = session::get('id_user');
        $full_name = self::verify_input($req->input('full_name'));
        $email = self::verify_input($req->input('email'));
        $phone = self::verify_input($req->input('phone'));
        $old_pass = self::verify_input($req->input('old_pass'));
        $new_pass = self::verify_input($req->input('new_pass'));
        $confirm_pass = self::verify_input($req->input('confirm_pass'));
        $PASSWORD_REGEX = '/^(?=.*\d).{5,25}$/';
        $PHONE_REGEX = '/(\+237|237)\s(6|2)(2|3|[5-9])[0-9]{7}/';
        $old_admin_image = self::verify_input($req->input('old_image_user'));;
        $photo = $_FILES['image_admin']['name'];
        $EMAIL_REGEX = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        $req->validate([
            'full_name' => 'required',
            'email' => 'required|email',
        ]);

        if (!preg_match($EMAIL_REGEX, $email)) {
            return back()->with('error_update', 'Cette adresse email est invalide');
        }
        if (!isset($photo) || empty($photo)) {
            if (
                !isset($old_pass_admin) || empty($old_pass_admin)
            ) {
                $user_request = DB::table('users')->where('ID_USER', $id_user)->first();
                if ($user_request) {
                    if ($user_request->EMAIL == $email) {

                        if (DB::update(
                            'update users set FULL_NAME=?, EMAIL=?, TELEPHONE=?, PHOTO_USER=?, DATE_UPDATE=?
                            where ID_USER=?',
                            [
                                $full_name,
                                $email,
                                $phone,
                                $old_admin_image,
                                Carbon::now(),
                                $id_user,

                            ]
                        )) {
                            return back()->with('success_update', 'La modification a été effectué avec success');
                        } else {
                            return back()->with('error_update', 'La modification de votre profil a échoué');
                        }
                    } else {
                        if (DB::table('users')->where('EMAIL', $email)) {
                            return back()->with('error_update', 'Cette adresse email est deja utiliée');
                        } else {

                            if (DB::update(
                                'update users set FULL_NAME=?, EMAIL=?, TELEPHONE=?, DATE_UPDATE=?
                                where ID_USER=?',
                                [
                                    $full_name,
                                    $email,
                                    $phone,
                                    Carbon::now(),
                                    $id_user,

                                ]
                            )) {
                                return back()->with('success_update', 'La modification a été effectué avec success');
                            } else {
                                return back()->with('error_update', 'La modification de votre profil a échoué');
                            }
                        }
                    }
                }
            } else {
                if (!isset($new_pass_admin) || empty($new_pass_admin) || !isset($confirm_pass_admin) || empty($confirm_pass_admin)) {
                    return back()->with('error_update', 'Veillez remplir tous les champs de mot de passe');
                }
                if (!preg_match($PASSWORD_REGEX, $new_pass)) {
                    return back()->with('error_update', 'Pour des raison de securité le mot de passe doit avoir au moins 5 caractere, possedé des nombre et des symboles');
                }
                if ($new_pass != $confirm_pass) {
                    return back()->with('error_update', 'Le nouveau mot de passe est different de la confirmation');
                }

                $password_admin = DB::table('users')
                    ->where('ID_USER', session::get('id_user'))
                    ->first();
                if (Hash::check($old_pass, $password_admin->PASSWORD)) {
                    if (DB::update(
                        'update users set FULL_NAME=?, EMAIL=?, PASSWORD=?, TELEPHONE=?,  DATE_UPDATE=?
                    where ID_USER=?',
                        [
                            $full_name,
                            $email,
                            Hash::make($new_pass),
                            $phone,
                            Carbon::now(),
                            $id_user

                        ]
                    )) {
                        return back()->with('success_update', 'La modification a été effectué avec success');
                    } else {
                        return back()->with('error_update', 'La modification a échoué');
                    }
                } else {
                    return back()->with('error_update', "L'ancien mot de passe ne correspond pas");
                }
            }
        } else {
            if (isset($_FILES['image_admin']) and $_FILES['image_admin']['error'] == 0) {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['image_admin']['size'] <= 10000000) {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['image_admin']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $photo = uniqid() . '.' . $extension_upload;
                    $upload = "img_user/" . $photo;
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'PNG');
                    if (in_array($extension_upload, $extensions_autorisees)) {
                        if (
                            !isset($old_pass_admin) || empty($old_pass_admin)
                        ) {
                            $user_request = DB::table('users')->where('ID_USER', $id_user)->first();
                            if ($user_request) {
                                move_uploaded_file($_FILES['image_admin']['tmp_name'], $upload);
                                if ($user_request->EMAIL == $email) {

                                    if (DB::update(
                                        'update users set FULL_NAME=?, EMAIL=?, TELEPHONE=?, PHOTO_USER=?, DATE_UPDATE=?
                                        where ID_USER=?',
                                        [
                                            $full_name,
                                            $email,
                                            $phone,
                                            $photo,
                                            Carbon::now(),
                                            $id_user,

                                        ]
                                    )) {
                                        return back()->with('success_update', 'La modification a été effectué avec success');
                                    } else {
                                        return back()->with('error_update', 'La modification de votre profil a échoué');
                                    }
                                } else {
                                    if (DB::table('users')->where('EMAIL', $email)) {
                                        return back()->with('error_update', 'Cette adresse email est deja utiliée');
                                    } else {
                                        move_uploaded_file($_FILES['image_admin']['tmp_name'], $upload);
                                        if (DB::update(
                                            'update users set FULL_NAME=?, EMAIL=?, TELEPHONE=?, PHOTO_USER, DATE_UPDATE=?
                                            where ID_USER=?',
                                            [
                                                $full_name,
                                                $email,
                                                $phone,
                                                $photo,
                                                Carbon::now(),
                                                $id_user

                                            ]
                                        )) {
                                            return back()->with('success_update', 'La modification a été effectué avec success');
                                        } else {
                                            return back()->with('error_update', 'La modification de votre profil a échoué');
                                        }
                                    }
                                }
                            }
                        } else {
                            if (!isset($new_pass_admin) || empty($new_pass_admin) || !isset($confirm_pass_admin) || empty($confirm_pass_admin)) {
                                return back()->with('error_update', 'Veillez remplir tous les champs de mot de passe');
                            }
                            if (!preg_match($PASSWORD_REGEX, $new_pass)) {
                                return back()->with('error_update', 'Pour des raison de securité le mot de passe doit avoir au moins 5 caractere, possedé des nombre et des symboles');
                            }
                            if ($new_pass != $confirm_pass) {
                                return back()->with('error_update', 'Le nouveau mot de passe est different de la confirmation');
                            }

                            $password_admin = DB::table('users')
                                ->where('ID_USER', session::get('id_user'))
                                ->first();
                            if (Hash::check($old_pass, $password_admin->PASSWORD)) {
                                move_uploaded_file($_FILES['image_admin']['tmp_name'], $upload);
                                if (DB::update(
                                    'update users set FULL_NAME=?, EMAIL=?, PASSWORD=?, TELEPHONE=?, PHOTO_USER, DATE_UPDATE=?
                                where ID_USER=?',
                                    [
                                        $full_name,
                                        $email,
                                        Hash::make($new_pass),
                                        $phone,
                                        $photo,
                                        Carbon::now(),
                                        $id_user

                                    ]
                                )) {
                                    return back()->with('success_update', 'La modification a été effectué avec success');
                                } else {
                                    return back()->with('error_update', 'La modification a échoué');
                                }
                            } else {
                                return back()->with('error_update', "L'ancien mot de passe ne correspond pas");
                            }
                        }
                    } else {
                        return back()->with('error_site', "Mauvaise extension d'image !! les extentions autorisé sont jpg, jpeg, gif, PNG");
                    }
                } else {
                    return back()->with('error_site', "la taille du fichier doit etre inferieur a 5Mo");
                }
            } else {
                return back()->with('error_site', "Veillez selectionnez une image");
            }
        }
    }
}
