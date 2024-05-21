<?php
class zamowienie{
    private $data;
    private $koszt;
    private $adres;
    private $miasto;
    private $metoda_p;
    private $metoda_d;
    private $numer;
    private $email;
    private $imie;
    private $nazwisko;
    private $kod;

    /**
     * @param $data
     * @param $koszt
     * @param $adres
     * @param $miasto
     * @param $metoda_p
     * @param $metoda_d
     * @param $numer
     * @param $email
     * @param $imie
     * @param $nazwisko
     * @param $kod
     */
    public function __construct($data, $koszt, $adres, $miasto, $metoda_p, $metoda_d, $numer, $email, $imie, $nazwisko, $kod)
    {
        $this->data = $data;
        $this->koszt = $koszt;
        $this->adres = $adres;
        $this->miasto = $miasto;
        $this->metoda_p = $metoda_p;
        $this->metoda_d = $metoda_d;
        $this->numer = $numer;
        $this->email = $email;
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
        $this->kod = $kod;
    }


    function Dodaj()
    {
        include 'config.php';
        $query = "INSERT into zamowienia( data, koszt,adres,miasto,metoda_p,metoda_d,numer,email,imie,nazwisko,kod) VALUES ('$this->data', '$this->koszt', '$this->adres', '$this->miasto', '$this->metoda_p', '$this->metoda_d', '$this->numer', '$this->email', '$this->imie', '$this->nazwisko', '$this->kod')";
        $conn->query($query);
    }



}
