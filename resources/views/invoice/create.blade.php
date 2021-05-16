<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Invoice Form | Seminar</title>
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
    <link href="/css/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="/img/bootstrap-logo.svg" alt="" width="72" height="57">
        <h2>Invoice form</h2>
      </div>

      <div class="row g-5">
        <div class="col-md-12 col-lg-12">
          <h4 class="mb-3">Billing address</h4>
          <form action="{{ route('invoice.save') }}" method="POST" novalidate>
            @csrf
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="fname" class="form-label">First name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" required>

                @error('fname')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-sm-6">
                <label for="lname" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" required>
                @error('lname')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('lname') }}" required>
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit price</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i = 0; $i < 5; $i++)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                      <input type="text" class="form-control" name="product[{{ $i }}][name]" value="{{ old('product.' . $i . '.name') }}" required>
                      @error('product.' . $i . '.name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </td>
                    <td>
                      <input type="number" class="form-control" name="product[{{ $i }}][amount]" value="{{ old('product.' . $i . '.amount') }}" min="1" required>
                      @error('product.' . $i . '.amount')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </td>
                    <td>
                      <input type="number" class="form-control" name="product[{{ $i }}][unit_price]" value="{{ old( 'product.' . $i . '.unit_price') }}" min="1" step="50" required>
                      @error('product.' . $i . '.unit_price')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </td>
                  </tr>
                  @endfor

                </tbody>
              </table>
            </div>
          </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
          </form>
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
