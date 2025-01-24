<?php

if (!function_exists('convertYearToLabel')) {
    /**
     * Convert a year to TS label.
     *
     * @param int $year
     * @param int $currentYear
     * @return string
     */
    function konversiTahunTS($year, $currentYear = null)
    {
        if (is_null($currentYear)) {
            $currentYear = date('Y');
        }

        $diff = $currentYear - $year;

        if ($diff == 0) {
            return 'TS';
        } elseif ($diff > 0) {
            return 'TS-' . $diff;
        } else {
            return 'Invalid Year';
        }
    }
}
