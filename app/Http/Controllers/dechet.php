public function update_publication(Request $req, $id_pub, $id_prod)
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
            'image_prod' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        if ($photo) {
            $infosfichier = pathinfo($_FILES['image_prod']['name']);
            $extension_upload = $infosfichier['extension'];
            $photo = uniqid() . '.' . $extension_upload;
            $upload = "img_product/" . $photo;
            if (move_uploaded_file($_FILES['image_prod']['tmp_name'], $upload)) {
                $update_prod = DB::table('produits')->where('ID_PRODUIT', $id_prod)
                    ->update([
                        "NOM_PROD" => $nom_prod,
                        "PRIX_PROD" => $prix_prod,
                        "DESC_PRODUIT" => $desc_prod,
                        "ETAT_STOCK" => 1,
                        "DATE_UPDATE" => Carbon::now(),
                    ]);
                if ($update_prod) {
                    $update_pub = DB::table('publications')->where('ID_PUBLICATION', $id_pub)
                        ->update(
                            [
                                "ETAT_PUB" => 1,
                                "DATE_MODIF_PUB" => Carbon::now(),
                            ]
                        );
                    if ($update_pub) {
                        $update_image = DB::table('images_pub')->where('images_pub.ID_PUBLICATION', $id_pub)
                            ->update(
                                [
                                    "LIBELLE_IMAGE" => $photo,
                                ]
                            );
                        if ($update_image) {
                            return back()->with('success', "La modification a été effectuer avec success !!!");
                        } else {
                            return back()->with('error', "Une erreur c'est produite lors de la modification de l'image de la publication!!! veillez reesayer");
                        }
                    } else {
                        return back()->with('error', "Une erreur c'est produite lors de la modification de la publication!!! veillez reesayer");
                    }
                } else {
                    return back()->with('error', "Une erreur c'est produite lors de la modification des information du produit!!! veillez reesayer");
                }
            } else {
                return back()->with('error', "Une erreur c'est produite lors de l'upload du fichier'!!! veillez reesayer");
            }
        } else {
            $update_prod = DB::table('produits')
                ->update([
                    "NOM_PROD" => $nom_prod,
                    "PRIX_PROD" => $prix_prod,
                    "DESC_PRODUIT" => $desc_prod,
                    "ETAT_STOCK" => 1,
                    "DATE_UPDATE" => Carbon::now(),
                ]);
            if ($update_prod) {
                $update_pub = DB::table('publications')->where('ID_PUBLICATION', $id_pub)
                    ->update(
                        [
                            "ETAT_PUB" => 1,
                            "DATE_MODIF_PUB" => Carbon::now(),
                        ]
                    );
                if ($update_pub) {
                    return back()->with('success', "La modification a été effectuer avec success !!!");
                } else {
                    return back()->with('error', "Une erreur c'est produite lors de la modification de la publication!!! veillez reesayer");
                }
            } else {
                return back()->with('error', "Une erreur c'est produite lors de la modification de la publication!!! veillez reesayer");
            }
        }
    }
