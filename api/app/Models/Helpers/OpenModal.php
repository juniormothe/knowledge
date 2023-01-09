<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class OpenModal
{
    function __construct($idModal)
    {
        $modal = '<script type="text/javascript">
        $(document).ready(function() {
            $("#' . $idModal . '").modal("show");
        });
        </script>';
        @define('OPEN_MODAL', $modal);
    }
}
