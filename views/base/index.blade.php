<!DOCTYPE html>
<html>
    @include("base.header")
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/candidatos">Candidatos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eleitores">Eleitores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/periodos">Períodos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/votacao">Votar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/resultado">Acompanhar resultados</a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield("container")
        </div>
        @include("base.footer")
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>