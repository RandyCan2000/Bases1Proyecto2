<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active" >
        <a class="nav-link" href="../user/user.php">Consultas<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tablas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../Tablas/pais.php">Pais</a>
            <a class="dropdown-item" href="../Tablas/pregunta.php">Pregunta</a>
            <a class="dropdown-item" href="../Tablas/inventos.php">Inventos</a>
        </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../index.php" onclick="exit_sesion()">Cerrar Sesion</a>
        </li>
    </ul>
    </div>
</nav>
<script>
    function exit_sesion(){
        sessionStorage.setItem('Logueado', 'false');
    }
</script>