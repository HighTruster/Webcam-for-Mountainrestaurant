<?php
/**
 * Created by PhpStorm.
 * User: MartinKuenzler
 * Date: 14.03.16
 * Time: 13:45
 *
 */
class camHandler
{

    /**
     * Die Funktion erstellenFoto() ermöglicht es ein neues Panoramabild zu
     * erstellen. Dabei verwenden wir einige Funktionen welche das datum
     * erbringen und somit den Filename erbringen.
     *
     * Der Ordner wird druchsucht und anschliessend wird der Inhalt ins Archiv
     * gespeichert. Somit können alle Daten behalten werden.
     */
    public function erstellenFoto()
    {
        $file1 = date("d-m-Y_Hi") . ".jpg";
        //var_dump($file1);
        $handle = opendir('../imc/aktuell/'); //öffnen des Ordners
        while (($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                if
                (@rename("../imc/aktuell/" .
                    $file, "../imc/archiv/" . $file1)
                ) {
                } else {
                    echo "Leider konnten die Dateien nicht verschoben werden";
                }
            }
        }
        closedir($handle); // Ordner wird geschlossen

        $ip = 'http://10.142.126.154/cgi-bin/'; // IP-Adresse der IP-Kamera

        $verzeichnis = "../imc/aktuell/"; //Verzeichnis für die Bilder

        $left = $ip . "camctrl.cgi?move=left&speedpan=4";

        $right = $ip . "camctrl.cgi?move=right&speedpan=4";

        $home = $ip . "camctrl.cgi?move=home";

        //setzen der Webcam auf die Homeposition
        fopen($home, 'r');

        // Webcam 2 Mal nach rechts bewegen
        for ($i = 0; $i < 2; $i++) {
            // URL wird geöffnet mit "Read" rechten
            fopen($right, "r");
        }

        sleep(2); // abwarten 2 Sekunden

        /**
         * In der Variabel $photo1 wird der Inhalt von
         * 'http://10.142.126.154/cgi-bin/video.jpg gespeichert
         */
        $photo1 = file_get_contents('http://10.142.126.154/cgi-bin/video.jpg');

        $dateiName = date("dmYHis") . ".png"; // erhalten des Dateinamens

        // Inhalt der Seite wird in eine Datei gespeichert
        file_put_contents('../imc/' . $dateiName, $photo1);

        // Webcam 2 Mal nach links bewegen
        for ($i = 0; $i < 2; $i++) {
            // URL wird geöffnet mit "Read" rechten
            fopen($left, "r");

        }

        sleep(2);// abwarten 2 Sekunden

        /**
         * In der Variabel $photo2 wird der Inhalt von
         * 'http://10.142.126.154/cgi-bin/video.jpg gespeichert
         */
        $photo2 = file_get_contents('http://10.142.126.154/cgi-bin/video.jpg');

        $dateiName2 = date("dmYHis") . ".png"; // erhalten des Dateinamens

        // Inhalt der Seite wird in eine Datei gespeichert
        file_put_contents('../imc/' . $dateiName2, $photo2);

        // Webcam 2 Mal nach links bewegen
        for ($i = 0; $i < 2; $i++) {
            // URL wird geöffnet mit "Read" rechten
            fopen($left, "r");

        }
        sleep(2);// abwarten 2 Sekunden
        /**
         * In der Variabel $photo3 wird der Inhalt von
         * 'http://10.142.126.154/cgi-bin/video.jpg gespeichert
         */
        $photo3 = file_get_contents('http://10.142.126.154/cgi-bin/video.jpg');

        $dateiName3 = date("dmYHis") . ".png"; // erhalten des Dateinamens

        // Inhalt der Seite wird in eine Datei gespeichert
        file_put_contents('../imc/' . $dateiName3, $photo3);

        // Webcam 2 Mal nach links bewegen
        for ($i = 0; $i < 2; $i++) {
            // URL wird geöffnet mit "Read" rechten
            fopen($left, "r");

        }
        sleep(2);// abwarten 2 Sekunden

        /**
         * In der Variabel $photo4 wird der Inhalt von
         * 'http://10.142.126.154/cgi-bin/video.jpg gespeichert
         */
        $photo4 = file_get_contents('http://10.142.126.154/cgi-bin/video.jpg');

        $dateiName4 = date("dmYHis") . ".jpg"; // erhalten des Dateinamens

        // Inhalt der Seite wird in eine Datei gespeichert
        file_put_contents('../imc/' . $dateiName4, $photo4);


        $imageSource1 = imagecreatefromjpeg('../imc/' . $dateiName);
        $imageSource2 = imagecreatefromjpeg('../imc/' . $dateiName2);
        $imageSource3 = imagecreatefromjpeg('../imc/' . $dateiName3);
        $imageSource4 = imagecreatefromjpeg('../imc/' . $dateiName4);

        //Grösse und Breite des Bildes
        $widht = 640;
        $high = 480;

        // Die Leinwand des Bildes wird erstellt 2560 * 480
        $png = imagecreatetruecolor($widht * 4, $high);

        imagecopy($png, $imageSource4, 0, 0, 0, 0, $widht, $high);
        imagecopy($png, $imageSource3, 640, 0, 0, 0, $widht, $high);
        imagecopy($png, $imageSource2, 1280, 0, 0, 0, $widht, $high);
        imagecopy($png, $imageSource1, 1920, 0, 0, 0, $widht, $high);

        $dateiName5 = date("dmYHi") . ".jpg"; // erhalten des Dateinamens
        imagepng($png, $verzeichnis . $dateiName5); // Bidl wird erstellt
        imagedestroy($png);
        // Die Kamera wird wieder auf die Homeposition gestellt
        fopen($home, 'r');

        /**
         * Entfernen der Temporären Dateien die nicht mehr gebraucht werden
         */
        unlink($dateiName);
        unlink($dateiName2);
        unlink($dateiName3);
        unlink($dateiName4);

    }

    /**
     * Diese Funktion ermöglicht es alle Bilder die älter als 14 Tage sind
     * zu löschen. Dabei wird eine überprüfung statfinden, welche
     * überwacht, ob der Filenamen auch dem Zeitstempel entspricht
     */
    public function loeschenVonBildern()
    {
        $handle = opendir('../imc/archiv/'); // öffnen des Ordners
        while (($file = readdir($handle)) !== false) {
            // Der Dateiname wird nach . aufgesplittet
            $teile = explode(".", $file);
            // die Variable $datei speichert das Datum (dd-mm-yyyy)
            $datei = strtotime($teile[0]);
            // $limit wird als Wochenbeschränkung setzen (heute vor 14 Tagen)
            $limit = strtotime(" - 1 week");
            // Abfrage ist es ein File und stimmt das Datum
            if ($file != '.' && $file != '..' && $datei <= $limit) {
                unlink('../imc/archiv/' . $file); // löschen des Files
            }
        }
        closedir($handle); // Ordner schliessen
    }


    /**
     * Alle Dateien sollten im ARchiv auch angeziegt werden können
     * Damit diese nicht alle auf nur einer Seite auftauchen
     * verwenden wir die Pageination. Dazu muss ein Limit und ein Anfang
     * erstellt werden
     *
     * Auch eine überprüfung der Datentypen sollte durchgeführt werden
     */
    public
    function archivAnzeigen()
    {
        $dir = '../imc/archiv/'; // Verzeichnis in Variable speichern
        $allow = array('jpg', 'jpeg', 'JPEG', 'JPG');

        $i = 0;
        $open = opendir($dir);
        // Wir erhalten mit diesem Codestück alle Files
        while (($file = readdir($open)) !== false) {
            // überprüfung der Endung
            $ext = str_replace('.', '', strrchr($file, '.'));
            // ist es eine korrekte Endung
            if (in_array($ext, $allow))
                $list[$i++] = $file;
        }

        $perPage = 10; // Anzahl der anzuzeigenden Bilder pro Seite
        $total = count($list); // Alle Bilder wie im Verzeichnis sind
        $pages = ceil($total / $perPage);

        $thisPage = isset($_GET['pg']) ? $_GET['pg'] - 1 : 0;
        $start = $thisPage * $perPage;
        $perRow = 2;
        print "Seite";
        // Eine Forschlaufe für den Durchlauf der Seiten
        for ($i = 0; $i < $pages; $i++)
            if ($i == $thisPage)
                print ": " . ($i + 1); // ausgabe der Anzahl Seiten
            else
                // Anzahl der Seite ist wird angezeigt.
                print " / <a href='?pg=" . ($i + 1) . "'>" . ($i + 1) . "</a>";
        print "";
        $imgCnt = 0; // Variable wird gesetzt auf 0
        for ($i = $start; $i < $start + $perPage; $i++) {
            if (isset($list[$i]))// überprüfung der Dateien ANzahl
                print "<a class='thumbnail' href='$dir{$list[$i]}'>
                            <img src='$dir{$list[$i]}' alt='$dir{$list[$i]}'>
                       </a>"; // Ausgabe aller BIlder in einer Liste
            else
                print "";
            $imgCnt += 1; // increment images shown
            if ($imgCnt % $perRow == 0)
                print "";
        }
        closedir($open); // Schliessen des Ordners
    }
}
?>