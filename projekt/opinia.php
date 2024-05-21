<?php
class opinia{
    private $id_uzytkownika;
    private $id_produktu;
    private $ocena;
    private $tekst;

use dodawanie;
    /**
     * @param $id_produktu
     * @param $id_uzytkownika
     * @param $ocena
     * @param $tekst
     */
    public function __construct($id_uzytkownika,$id_produktu, $ocena, $tekst)
    {
        $this->id_uzytkownika = $id_uzytkownika;
        $this->id_produktu = $id_produktu;
        $this->ocena = $ocena;
        $this->tekst = $tekst;
        }

    function Dodaj()
    {
        include 'config.php';
        $query = "INSERT into opinia(id_uzytkownika, id_produktu,ocena,tekst) VALUES ( '$this->id_uzytkownika', '$this->id_produktu',' $this->ocena',' $this->tekst')";
        $conn->query($query);
    }



}
