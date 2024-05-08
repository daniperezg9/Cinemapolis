<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Modifica Usuario';

$contenidoPrincipal = '';

if(isset($_SESSION['login']) && isset($_SESSION['admin']) && $_SESSION['login'] && $_SESSION['admin']){
    $formReg=new FormularioModificaUsuarioPropio();
    $formReg2=new FormularioModificaUsuarioAjeno();
    $formReg3=new FormularioBorrarUsuarioAjeno();
    $htmlForm=$formReg->gestiona();
    $htmlForm2=$formReg2->gestiona();
    $htmlForm3=$formReg3->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
        $htmlForm2
        $htmlForm3
    EOS;
} 
else if(isset($_SESSION['login']) && isset($_SESSION['admin']) && $_SESSION['login'] && !$_SESSION['admin']){
    $formReg=new FormularioModificaUsuarioPropio();
    $htmlForm=$formReg->gestiona();
    $formReg2=new FormularioBorrarUsuarioPropio();
    $htmlForm2=$formReg2->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
        $htmlForm2
    EOS;
}
    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>