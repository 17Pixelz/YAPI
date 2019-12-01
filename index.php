<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/project/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/project/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="/project/content/channels.php">Channels</a>
            <a class="nav-item nav-link" href="/project/content/comments.php">Comments</a>
            <a class="nav-item nav-link" href="/project/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>
    <div class="container z">
        <form class="needs-validation" method="GET" action="./api/search.php">
            <div class="input-group mb-6 a">
                <div class="input-group-prepend">
                    <span class="input-group-text b" id="basic-addon1">mot cle:</span> <input class="form-control" type="search" id="q" name="q" placeholder="entrer le(s) mot(s) cle(s)">
                </div>
            </div>
            <div class="input-group mb-6 a">
                <div class="input-group-prepend">
                    <span class="input-group-text b" id="basic-addon1">date start:</span> <input class="form-control" type="date" id="ds" name="ds">
                </div>
            </div>
            <div class="input-group mb-6 a">
                <div class="input-group-prepend">
                    <span class="input-group-text b" id="basic-addon1">date fin:</span> <input class="form-control" type="date" id="df" name="df">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>