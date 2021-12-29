<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class publicationController extends Controller
{
    public function create_publication()
    {
        return view('create_publication');
    }

    public function create_my_pub()
    {
        $info_prod = DB::table('publications')
        ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
        ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
        ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
        ->where('users.ID_USER', session::get("id_user"))
        ->get([
            "LIBELLE_IMAGE" => "images_pub.LIBELLE_IMAGE",
            "ID_PUBLICATION " => "publications.ID_PUBLICATION",
            "ID_PRODUIT " => "produits.ID_PRODUIT",
            "NOM_PROD	" => "produits.NOM_PROD",
            "PRIX_PROD" => "produits.PRIX_PROD",
            "DESC_PRODUIT" => "produits.DESC_PRODUIT",
            "ETAT_STOCK" => "produits.ETAT_STOCK",
            "ETAT_PUB" => "publications.ETAT_PUB",
        ]);
    if ($info_prod) {
        // dd($info_prod);
        return view(
            'list_publication',
            [
                'info_prod' => $info_prod
            ]
        );
    } else {
        return view(
            'list_publication',
            [
                'error' => "Une erreur c'est produite lors du chargement de la page!!! veillez reesayer"
            ]
        );
    }
    }

    public function edit_pub($id_pub)
    {
        $info_prod = DB::table('publications')
            ->where('publications.ID_PUBLICATION', $id_pub)
            ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
            ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
            ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
            ->get([
                "LIBELLE_IMAGE" => "images_pub.LIBELLE_IMAGE",
                "ID_PUBLICATION " => "publications.ID_PUBLICATION",
                "ID_PRODUIT " => "produits.ID_PRODUIT",
                "NOM_PROD	" => "produits.NOM_PROD",
                "PRIX_PROD" => "produits.PRIX_PROD",
                "DESC_PRODUIT" => "produits.DESC_PRODUIT",
                "ETAT_STOCK" => "produits.ETAT_STOCK",
                "ETAT_PUB" => "publications.ETAT_PUB",
            ]);
        if ($info_prod) {
            // dd($info_prod);
            return view(
                'edit_publication',
                [
                    'info_prod' => $info_prod
                ]
            );
        } else {
            return view(
                'edit_publication',
                [
                    'error' => "Une erreur c'est produite lors du chargement de la page!!! veillez reesayer"
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

    public function store_publication(Request $req)
    {
        $nom_prod = self::verify_input($req->input('nom_prod'));
        $prix_prod = self::verify_input($req->input('prix_prod'));
        $desc_prod = self::verify_input($req->input('desc_prod'));
        $photo = $_FILES['image_prod']['name'];

        $req->validate([
            'nom_prod' => 'required|min:4',
            'prix_prod' => 'required',
            'desc_prod' => 'required|min:8',
            'image_prod' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        $infosfichier = pathinfo($_FILES['image_prod']['name']);
        $extension_upload = $infosfichier['extension'];
        $photo = uniqid() . '.' . $extension_upload;
        $upload = "img_product/" . $photo;
        if (move_uploaded_file($_FILES['image_prod']['tmp_name'], $upload)) {
            $insert_prod = DB::table('produits')->insert(
                [
                    "NOM_PROD" => $nom_prod,
                    "PRIX_PROD" => $prix_prod,
                    "DESC_PRODUIT" => $desc_prod,
                    "ETAT_STOCK" => 1,
                    "DATE_CREATE" => Carbon::now(),
                    "DATE_UPDATE" => Carbon::now(),
                ]
            );
            if ($insert_prod) {
                $id_prod = DB::select("SELECT currval(pg_get_serial_sequence('produits','ID_PRODUIT'));");
                $insert_pub = DB::table('publications')->insert(
                    [
                        "ID_USER" => session::get('id_user'),
                        "ID_PRODUIT" => $id_prod,
                        "ETAT_PUB" => 1,
                        "DATE_PUB" => Carbon::now(),
                        "DATE_MODIF_PUB" => Carbon::now(),
                    ]
                );
                if ($insert_pub) {
                    $id_pub = DB::select("SELECT currval(pg_get_serial_sequence('publications','ID_PUBLICATION'));");
                    $insert_image = DB::table('images_pub')->insert(
                        [
                            "ID_PUBLICATION" => $id_pub,
                            "LIBELLE_IMAGE" => $photo,
                        ]
                    );
                    if ($insert_image) {
                        return redirect("/");
                    } else {
                        return back()->with('error', "Une erreur c'est produite lors de l'enreigistrement de l'image !!! veillez reesayer");
                    }
                } else {
                    return back()->with('error', "Une erreur c'est produite lors de la publication !!! veillez reesayer");
                }
            } else {
                return back()->with('error', "Une erreur c'est produite lors de la publication !!! veillez reesayer");
            }
        } else {
            return back()->with('error', "Une erreur c'est produite lors de l'upload du fichier'!!! veillez reesayer");
        }
    }

    public function update_publication(Request $req, $id_pub)
    {
        $nom_prod = self::verify_input($req->input('nom_prod'));
        $prix_prod = self::verify_input($req->input('prix_prod'));
        $desc_prod = self::verify_input($req->input('desc_prod'));
        $photo = $_FILES['image_prod']['name'];
        $old_image_prod = self::verify_input($req->input('old_image_prod'));

        $req->validate([
            'nom_prod' => 'required|min:4',
            'prix_prod' => 'required',
            'desc_prod' => 'required|min:8',
            'image_prod' => 'image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        if ($photo) {
            $infosfichier = pathinfo($_FILES['image_prod']['name']);
            $extension_upload = $infosfichier['extension'];
            $photo = uniqid() . '.' . $extension_upload;
            $upload = "img_product/" . $photo;
            if (move_uploaded_file($_FILES['image_prod']['tmp_name'], $upload)) {
                $update_pub = DB::table('publications')
                    ->where('publications.ETAT_PUB', 1)
                    ->where('publications.ID_PUBLICATION', $id_pub)
                    ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
                    ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
                    ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
                    ->update([
                        "produits.NOM_PROD" => $nom_prod,
                        "produits.PRIX_PROD" => $prix_prod,
                        "produits.DESC_PRODUIT" => $desc_prod,
                        "produits.ETAT_STOCK" => 1,
                        "publications.DATE_MODIF_PUB" => Carbon::now(),
                        "images_pub.LIBELLE_IMAGE" => $photo,
                    ]);
                if ($update_pub) {
                    return back()->with('success', "La modification a été effectuer avec success !!!");
                } else {
                    return back()->with('error', "Une erreur c'est produite lors de la modification des information du produit!!! veillez reesayer");
                }
            }
        } else {
            $update_pub = DB::table('publications')
                ->where('publications.ETAT_PUB', 1)
                ->where('publications.ID_PUBLICATION', $id_pub)
                ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
                ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
                ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
                ->update([
                    "produits.NOM_PROD" => $nom_prod,
                    "produits.PRIX_PROD" => $prix_prod,
                    "produits.DESC_PRODUIT" => $desc_prod,
                    "produits.ETAT_STOCK" => 1,
                    "publications.DATE_MODIF_PUB" => Carbon::now(),
                    "images_pub.LIBELLE_IMAGE" => $old_image_prod,
                ]);
            if ($update_pub) {
                return back()->with('success', "La modification a été effectuer avec success !!!");
            } else {
                return back()->with('error', "Une erreur c'est produite lors de la modification des information du produit!!! veillez reesayer");
            }
        }
    }

    public function delete_publication(Request $req, $id_pub)
    {
        $update_pub = DB::table('publications')
            ->where('publications.ETAT_PUB', 1)
            ->where('publications.ID_PUBLICATION', $id_pub)
            ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
            ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
            ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
            ->update([
                "publications.ETAT_PUB" => 0,
                "publications.DATE_MODIF_PUB" => Carbon::now(),
            ]);
        if ($update_pub) {
            return redirect("/");
        } else {
            return back()->with('error', "Une erreur c'est produite lors de la suppression de la publication!!! veillez reesayer");
        }
    }

    public function active_publication(Request $req, $id_pub)
    {
        $update_pub = DB::table('publications')
            ->where('publications.ID_PUBLICATION', $id_pub)
            ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
            ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
            ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
            ->update([
                "publications.ETAT_PUB" => 1,
                "publications.DATE_MODIF_PUB" => Carbon::now(),
            ]);
        if ($update_pub) {
            return redirect("/");
        } else {
            return back()->with('error', "Une erreur c'est produite lors de la suppression de la publication!!! veillez reesayer");
        }
    }
}
