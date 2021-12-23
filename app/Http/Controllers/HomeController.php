<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create_home()
    {
        //$this->middleware('auth');

        $info_prod = DB::table('publications')
            ->where('publications.ETAT_PUB', 1)
            ->join('users', 'users.ID_USER', '=', 'publications.ID_USER')
            ->join('produits', 'produits.ID_PRODUIT', '=', 'publications.ID_PRODUIT')
            ->join('images_pub', 'images_pub.ID_PUBLICATION', '=', 'publications.ID_PUBLICATION')
            ->get([
                "LIBELLE_IMAGE" => "images_pub.LIBELLE_IMAGE",
                "ID_PUBLICATION " => "publications.ID_PUBLICATION",
                "ID_PRODUIT " => "publications.ID_PUBLICATION",
                "NOM_PROD	" => "produits.NOM_PROD",
                "PRIX_PROD" => "produits.PRIX_PROD",
            ]);
        if ($info_prod) {
           // dd($info_prod);
            return view(
                'home',
                [
                    'info_prod' => $info_prod
                ]
            );
        } else {
            return view(
                'home',
                [
                    'error' => "Une erreur c'est produite lors du chargement de la page!!! veillez reesayer"
                ]
            );
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
    }
}
