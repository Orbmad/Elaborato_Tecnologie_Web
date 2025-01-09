<?php
    /**
     * Restituisce la stringa passata dopo aver sostituito gli spazi con dei trattini.
     */
    function replaceSpacesWithHyphens($string) {
        $temp = $string;
        $newString = str_replace(' ', '-', $temp);
        return $newString;
    }
?>