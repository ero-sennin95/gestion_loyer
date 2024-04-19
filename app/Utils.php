<?php
namespace App;

class Utils{
    public static function get_LastDay_month($month,$year){
        
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
    public static function get_fr_month(int $month){
        $str='';
        switch ($month) {
            case 1:
                $str = "Janvier";
                break;
            case 2:
                $str = "Février";
                break;
            case 3:
                $str = "Mars";
                break;
            case 4:
                $str = "Avril";
                break;
            case 5:
                $str = "Mai";
                break;
            case 6:
                $str = "Juin";
                break;
            case 7:
                $str = "Juillet";
                break;
            case 8:
                $str = "Août";
                 break;
            case 9:
                $str = "Septembre";
                break;
            case 10:
                $str = "Octobre";
                break;
            case 11:
                $str = "Novembre";
                break;
            case 12:
                $str = "Décembre";
                break;
            default:
                $str="donnée invalide" ;
        }
        return $str;
    }

    public static function getPeriodForMonth(int $month,int $year) : string
    {
        $startPeriod = date('d/m/Y', mktime(0, 0, 0,$month,1, $year));
        $lastDay = self::get_LastDay_month($month,$year);
        $endPeriod = date('d/m/Y', mktime(0, 0, 0,$month,$lastDay, $year));
        return "Du $startPeriod au $endPeriod";
    }
    public static function getFirstDateOfMonth($date){
        $tb = explode("-",$date);
        //dd($tb);
        return  date('Y-m-d', mktime(0, 0, 0,$tb[1],1, $tb[0]));

    }
    public static function getLasttDateOfMonth($date){
        $tb = explode("-",$date);
        //dd($tb);
        return  date('Y-m-t', mktime(0, 0, 0,$tb[1],1, $tb[0]));

    }

    //Facture = credit
    //reglement = debit
    public static function getBalance(int $debt ,int $cred){
        return $debt - $cred;
    }

    public static function getBalance_formatedStr(int $debt ,int $cred){
        $solde = $debt - $cred;
        $str=''; // . $debt . '€';
        // <p class="text-primary">.text-primary</p>
        // <p class="text-secondary">.text-secondary</p>
        // <p class="text-success">.text-success</p>
        // <p class="text-danger">.text-danger</p>

        if($solde<0)
            $str .= '<p class="text-danger">Reste à payer ' . $solde . ' €'.'</p>';
        else if($solde >0){
            $str .= '<p class="text-secondary">Trop perçu ' . $solde . ' €' .'</p>';
        }
        else{
            $str .= '<p class="text-success">' . $solde . '€</p>';

        }
        return $str ;
    }

    public static function getPaimentDescStr($reglementsList){
        // dump($reglementsList);
        $str = '';
            foreach($reglementsList as $reglement){
                $str .= 'Reçu ' . $reglement->getMontant() .'€ le '.$reglement->getDate()  . ' <br>';
                // ' € de ' . $reglement->getPayeur() . 
            }
        return $str ;
    }

}