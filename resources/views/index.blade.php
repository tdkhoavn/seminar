<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Nested Sets Model | Seminar</title>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="/css/navbar.css" rel="stylesheet">
  </head>
  <body>

    <main>
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded" aria-label="Eleventh navbar example">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @php
                  // \DB::enableQueryLog();
                @endphp
                @foreach ($categories as $category)
                  @if ($category->children instanceof \Illuminate\Database\Eloquent\Collection && $category->children->isNotEmpty())
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($category->name) }}</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown09">

                      @foreach ($category->descendants as $children)
                      <li><a class="dropdown-item" href="#">{{ ucfirst($children->name) }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">{{ ucfirst($category->name) }}</a>
                  </li>
                  @endif
                @endforeach
                @php
                    // dd(\DB::getQueryLog());
                @endphp
              </ul>
            </div>
          </div>
        </nav>

        <div>
          <div class="bg-light p-5 rounded">
            <div class="col-sm-8 mx-auto">
              <h1>Navbar examples</h1>
              <p>This example is a quick exercise to illustrate how the navbar and its contents work. Some navbars extend the width of the viewport, others are confined within a <code>.container</code>. For positioning of navbars, checkout the <a href="../examples/navbar-static/">top</a> and <a href="../examples/navbar-fixed/">fixed top</a> examples.</p>
              <p>At the smallest breakpoint, the collapse plugin is used to hide the links and show a menu button to toggle the collapsed content.</p>
              <p>
                <a class="btn btn-primary" href="../components/navbar/" role="button">View navbar docs &raquo;</a>
              </p>
            </div>

            <div class="col-sm8-8 mx-auto">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @foreach (\App\Models\Category::descendantsOf(1) as $category)
                    @if ($loop->first)
                      <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($category->name) }}</li>
                    @else
                      <li class="breadcrumb-item"><a href="#">{{ ucfirst($category->name) }}</a></li>
                    @endif
                  @endforeach
                </ol>
              </nav>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @foreach (\App\Models\Category::descendantsAndSelf(1) as $category)
                    @if ($loop->first)
                      <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($category->name) }}</li>
                    @else
                      <li class="breadcrumb-item"><a href="#">{{ ucfirst($category->name) }}</a></li>
                    @endif
                  @endforeach
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 CBA</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

  </body>
</html>
