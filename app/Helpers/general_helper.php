<?php
////////////////////////////////////////////////////
/// Notification Messages
////////////////////////////////////////////////////

function formAlert()
{
    $session = session();
    $alert = $session->getFlashdata('error');
    $validation = \Config\Services::validation()->listErrors();
    if (!empty($alert)){
        return '<div class="alert alert-danger alert-dismissible alert-alt solid fade show">'.
               '	<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>'.
               '	</button>'. $validation .
               '</div>';
    }
}

function sweetAlert()
{
    try {
        $session = session();
        $alert = $session->getFlashdata('sweet');
        if (count((array)$alert) == 2){
            return "<script>".
                "    $(document).ready(function () {".
                "       setTimeout(function() {".
                "       'use strict';".
                "        swal.fire({".
                "            position: 'center',".
                "            icon: '".$alert[0]."',".
                "            title: '".$alert[1]."',".
                "            showConfirmButton: false,".
                "            timer: 2000".
                "        });".
                "       }, 300);".
                "    });".
                "</script>";
        }
        if (count((array)$alert) == 4){
            return  "<script>".
                "    $(document).ready(function () {".
                "            'use strict';".
                "            swal({".
                "                title: '".$alert[1]."',".
                "                text: '".$alert[2]."',".
                "                type: '".$alert[0]."',".
                "                showCancelButton: !0,".
                "                confirmButtonColor: '#f34141',".
                "                confirmButtonText: 'Sim, Deletar!',".
                "                cancelButtonText: 'Cancelar',".
                "                closeOnConfirm: !1".
                "            }).then(function(isConfirm) {".
                "                if (isConfirm.value) {".
                "                    window.location.href = '".$alert[3]."'".
                "                }".
                "            });".
                "        });".
                "</script>";
        }
    }catch (Exception $ex){
    }
}

function toastAlert()
{
    try {
        $session = session();
        $alert = $session->getFlashdata('toast');
        if (count((array)$alert) == 3) {
            return "<script>" .
                "    $(document).ready(function () {" .
                "           'use strict';".
                "           let config = {" .
                "	            positionClass: 'toast-top-center'," .
                "	            timeOut: 5e3," .
                "	            closeButton: !0," .
                "	            debug: !1," .
                "	            newestOnTop: !0," .
                "	            progressBar: !0," .
                "	            preventDuplicates: !0," .
                "	            onclick: null," .
                "	            showDuration: '300'," .
                "	            hideDuration: '1000'," .
                "	            extendedTimeOut: '1000'," .
                "	            showEasing: 'swing'," .
                "	            hideEasing: 'linear'," .
                "	            showMethod: 'fadeIn'," .
                "	            hideMethod: 'fadeOut'," .
                "	            tapToDismiss: !1" .
                "           };" .
                "           toastr." . $alert[0] . "('" . $alert[2] . "','" . $alert[1] . "',config);" .
                "        });" .
                "</script>";
        }
    }catch (Exception $ex){
    }
}

function prueba(){
    echo '<script>alert("funciona el helper");</script>';
}