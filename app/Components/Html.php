<?php


namespace App\Components;


class Html
{
    /**
     * @param $page
     * @param $perPage
     * @param $total
     * @return string
     */
    public static function paginator($page, $perPage, $total)
    {
        $lastPage = ceil($total / $perPage);

        $start = $page - 3;
        if ($start < 1) {
            $start = 1;
        }

        $end = $page + 3;
        if ($end > $lastPage) {
            $end = $lastPage;
        }

        $html = '<ul class="pagination">';
        if ($page > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="?'.buildHttpQuery(['page' => $page - 1]).'">Previous</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $html .= '<li class="page-item"><a class="page-link" href="?'.buildHttpQuery(['page' => $i]).'">'.$i.'</a></li>';
        }

        if ($page < $lastPage) {
            $html .= '<li class="page-item"><a class="page-link" href="?'.buildHttpQuery(['page' => $page + 1]).'">Next</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }

}