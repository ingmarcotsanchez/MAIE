<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item ">
        <a class="nav-link text-orange" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown">
            <span class="text-muted d-block text-orange"><?php echo $_SESSION["usu_nom"]."  ".$_SESSION["usu_ape"];?></span>
            <input type='hidden' id='sesion_cen_id' value=<?php echo $_SESSION["cen_id"];?> >
            <input type='hidden' id='sesion_cen_id' value=<?php echo $_SESSION["prog_id"];?> >
         </li>
    </ul>
</nav>