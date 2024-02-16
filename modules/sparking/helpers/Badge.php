<?php 
namespace app\modules\sparking\helpers;

class Badge {
    public static function JsonToString($time_elapsed, $color='info') 
    {
        $r = "- -- -";
        
        if (is_object($time_elapsed)) {
            $r = ($time_elapsed->y>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->y} año(s) </span>" : '') 
                . ($time_elapsed->m>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->m} mes(es) </span>" : '') 
                . ($time_elapsed->d>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->d} dia(s) </span>" : '') 
                . ($time_elapsed->h>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->h} hora(s) </span>" : '') 
                . ($time_elapsed->i>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->i} minuto(s) </span>" : '') 
                . ($time_elapsed->s>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->s} segundo(s) </span>" : '') 
                . ($time_elapsed->f>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed->f} milisegundo(s) </span>" : '');
        } else if (is_array($time_elapsed)) {
            $r = ($time_elapsed['y']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['y']} año(s) </span>" : '') 
                . ($time_elapsed['m']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['m']} mes(es) </span>" : '') 
                . ($time_elapsed['d']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['d']} dia(s) </span>" : '') 
                . ($time_elapsed['h']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['h']} hora(s) </span>" : '') 
                . ($time_elapsed['i']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['i']} minuto(s) </span>" : '') 
                . ($time_elapsed['s']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['s']} segundo(s) </span>" : '') 
                . ($time_elapsed['f']>0 ? "<span class=\"badge bg-{$color} rounded-pill me-1\">{$time_elapsed['f']} milisegundo(s) </span>" : '');
        }
        else {
            if (!empty($time_elapsed)) $r = json_encode($time_elapsed);
        }
        return $r;
    }
}