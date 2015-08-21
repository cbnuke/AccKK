<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model {

    function genGraph($income, $outcome) {
        $ans = array();

        foreach ($income as $row) {
            $index = explode(' ', $row['action_date'])[0];
            if (array_key_exists($index, $ans) == FALSE) {
                $ans[$index] = array('date' => $index, 'income' => 0, 'outcome' => 0);
            }
            $ans[$index]['income']+=$row['income'];
        }

        foreach ($outcome as $row) {
            $index = explode(' ', $row['action_date'])[0];
            if (array_key_exists($index, $ans) == FALSE) {
                $ans[$index] = array('date' => $index, 'income' => 0, 'outcome' => 0);
            }
            $ans[$index]['outcome']+=$row['outcome'];
        }

        asort($ans);

        $count = count($ans);
        $size = 10;
        if ($count > $size) {
            $i = 0;
            foreach ($ans as $key => $row) {
                $i++;
                if ($i <= $count - $size) {
                    unset($ans[$key]);
                }
            }
        }

        return $ans;
    }

}
