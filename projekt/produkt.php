<?php
class produkt extends rzecz{

    private$zdjecie;
    private$cena_bez;
    private$cena_z;
    private$ilosc;
    private$opisDuzy;
    private$rodzaj;

    use dodawanie;

    /**
     * @param $zdjecie
     * @param $cena_bez
     * @param $cena_z
     * @param $ilosc
     * @param $opisDuzy
     *  @param $rodzaj
     */
    public function __construct($tytul, $zdjecie, $cena_bez, $cena_z, $opis, $ilosc, $opisDuzy,$rodzaj)
    {
        $this->tytul = $tytul;
        $this->zdjecie = $zdjecie;
        $this->cena_bez = $cena_bez;
        $this->cena_z = $cena_z;
        $this->opis = $opis;
        $this->ilosc = $ilosc;
        $this->opisDuzy = $opisDuzy;
        $this->rodzaj=$rodzaj;
    }

    public function Dodaj()
    {
        include 'config.php';
        $query = "INSERT into produkty(tytul,zdjecie, cena_bez,cena_z,opis, ilosc,opisDuzy,rodzaj) VALUES ('$this->tytul', '$this->zdjecie', '$this->cena_bez',' $this->cena_z',' $this->opis', '$this->ilosc', '$this->opisDuzy','$this->rodzaj')";
        $conn->query($query);
    }

}
