<?php

function details($id)
{
    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}

function plats()
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits WHERE categorie = 1");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function boissons()
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits WHERE categorie = 2");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function ajouter_produit($nom, $categorie, $image, $prix, $description)
{

    if (require("connexion.php")) {

        $req = $access->prepare("INSERT INTO produits (nom, categorie, image, prix, description) VALUES (?, ?, ?, ?, ?)");
        $req->execute(array($nom, $categorie, $image, $prix, $description));
        $req->closeCursor();
    }
}

function afficher()
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits ORDER BY id DESC");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function deja_produit($nom, $image, $description)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits WHERE nom = ? OR image = ? OR description = ?");
        $req->execute(array($nom, $image, $description));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function produit($id)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits WHERE id = ?");
        $req->execute(array($id));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function modifier($nom, $categorie, $image, $prix, $description, $id)
{
    if (require("connexion.php")) {

        $req = $access->prepare("UPDATE produits SET nom = ?, categorie = ?, image = ?, prix = ?, description = ? WHERE id = ?");
        $req->execute(array($nom, $categorie, $image, $prix, $description, $id));
        $req->closeCursor();
    }
}

function supprimer($id)
{

    if (require("connexion.php")) {

        $req = $access->prepare("DELETE FROM produits WHERE id = ? ");
        $req->execute(array($id));
        $req->closeCursor();
    }
}

function supprimer_client($idC)
{

    if (require("connexion.php")) {

        $req = $access->prepare("DELETE FROM clients WHERE id = ? ");
        $req->execute(array($idC));
        $req->closeCursor();
    }
}

function admin($nom, $motdepase)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM administrateurs WHERE nom = ? AND motDePasse = ?");
        $req->execute(array($nom, $motdepase));
        if ($req->rowCount() == 1) {

            $data = $req->fetch();
            return $data;
        } else {
            return false;
        }
        $req->closeCursor();
    }
}

function client($nom, $motdepase)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE nom = ? AND motDePasse = ?");
        $req->execute(array($nom, $motdepase));
        if ($req->rowCount() == 1) {

            $data = $req->fetch();
            return $data;
        } else {
            return false;
        }
        $req->closeCursor();
    }
}

function suppClient($id)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE id = ?");
        $req->execute(array($id));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function verif_mdp($mdp)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE motDePasse = ?");
        $req->execute(array($mdp));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function verif_email($email)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE email = ?");
        $req->execute(array($email));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function verif_tel($tel)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE tel = ?");
        $req->execute(array($tel));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function verif_nom($nom)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE nom = ?");
        $req->execute(array($nom));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function afficher_clients()
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients ORDER BY id DESC");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function clients($email, $telephone, $motdepase)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE email = ? OR tel = ? OR motDePasse = ?");
        $req->execute(array($email, $telephone, $motdepase));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }
}

function modif_client($nom, $motdepasse, $tel, $sexe, $email, $id){
    if (require("connexion.php")) {

        $req = $access->prepare("UPDATE clients SET nom = ?, motDePasse = ?, tel = ?, sexe = ?, email = ? WHERE id = ?");
        $req->execute(array($nom, $motdepasse, $tel, $sexe, $email, $id));
        $req->closeCursor();
    }
}

function clt($cltid){
    
    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM clients WHERE id = ?");
        $req->execute(array($cltid));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }

}

function ajouter_panier2($cltid, $pid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("INSERT INTO paniers (client, produit) VALUES (?, ?)");
        $req->execute(array($cltid, $pid));
        $req->closeCursor();
    }
}

function panier($cltid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM paniers WHERE client = ?");
        $req->execute(array($cltid));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function deja_panier($cltid, $pid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM paniers WHERE client = ? AND produit = ?");
        $req->execute(array($cltid, $pid));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function afficher_panier($pid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM produits WHERE id = ?");
        $req->execute(array($pid));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function ajouter_client($nom, $email, $sexe, $tel, $motdepase)
{

    if (require("connexion.php")) {

        $req = $access->prepare("INSERT INTO clients (nom, email, sexe, tel, motDePasse) VALUES (?, ?, ?, ?, ?)");
        $req->execute(array($nom, $email, $sexe, $tel, $motdepase));
        $req->closeCursor();
    }
}

function vider_panier($cltid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("DELETE FROM paniers WHERE client = ?");
        $req->execute(array($cltid));
        $req->closeCursor();
    }
}

function vider_paniers()
{

    if (require("connexion.php")) {

        $req = $access->prepare("TRUNCATE paniers");
        $req->execute();
        $req->closeCursor();
    }
}

function retirer_panier($pid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("DELETE FROM paniers WHERE produit = ?");
        $req->execute(array($pid));
        $req->closeCursor();
    }
}

function archiver($id)
{
    if (require("connexion.php")) {

        $req = $access->prepare("UPDATE produits SET archiver = 1 WHERE id = ?");
        $req->execute(array($id));
        $req->closeCursor();
    }
}

function desarchiver($id)
{
    if (require("connexion.php")) {

        $req = $access->prepare("UPDATE produits SET archiver = 0 WHERE id = ?");
        $req->execute(array($id));
        $req->closeCursor();
    }
}

function commander($client, $produit, $quantite, $pu, $pt, $table)
{

    if (require("connexion.php")) {

        $req = $access->prepare("INSERT INTO commandes (client, produit, quantite, prixUnitaire, prixTotal, noTable ) VALUES (?, ?, ?, ?, ?, ?)");
        $req->execute(array($client, $produit, $quantite, $pu, $pt, $table));
        $req->closeCursor();
    }
}

function afficher_tables()
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM tables ORDER BY id DESC");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function creer_table($id)
{
    if (require("connexion.php")) {

        $req = $access->prepare("INSERT INTO tables (numero) VALUES (?)");
        $req->execute(array($id));
        $req->closeCursor();
    }
}

function afficher_commandes($cltid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM commandes WHERE client = ? ORDER BY dateCmd DESC");
        $req->execute(array($cltid));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function supp_cmd($id){
 
    if (require("connexion.php")) {

        $req = $access->prepare("DELETE  FROM commandes WHERE id = ?");
        $req->execute(array($id));
        $req->closeCursor();
    }
    
}

function mtnt_cmd($cltid){

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT SUM(prixTotal) AS mtnt FROM commandes WHERE client = ?");
        $req->execute(array($cltid));
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }

}

function table($tid)
{

    if (require("connexion.php")) {

        $req = $access->prepare("SELECT * FROM tables WHERE numero = ?");
        $req->execute(array($tid));
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
        $req->closeCursor();
    }
}

function supp_tbl($id)
{
 
    if (require("connexion.php")) {

        $req = $access->prepare("DELETE  FROM tables WHERE numero = ?");
        $req->execute(array($id));
        $req->closeCursor();
    }
    
}