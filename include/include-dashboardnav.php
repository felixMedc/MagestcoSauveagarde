<?php $id = $_GET['id']; ?>

<nav id="navbar">
    <div id="container-navbar">
        <ul>
            <li><a href="dashboard.php?id=<?= $id; ?>">Tableau de bord</a></li>
            <!-- <li><a href="">Mes factures</a></li> -->
            <li><a href="redirection.php?id=<?= $id ?>" target="_blank">Mon logiciel</a></li>
            <li><a href="services.php?id=<?= $id; ?>">Mes services</a></li>
            <li><a href="mooc.php?id=<?= $id; ?>">Mes formations</a></li>
            <li><a href="../../index.php">Deconnexion</a></li>
        </ul>
    </div>
</nav>

<script>
    // test session et retour connexion (placer dans menu général)
    var testsession = window.sessionStorage.getItem('session');
    if (!testsession) {
        document.location.href = "../login.php";
    };
</script>