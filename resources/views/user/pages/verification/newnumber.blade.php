<!doctype html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>DigiTalent</title>

   @include('user.includes.style')
</head>

<body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
<div class="row justify-content-center align-items-center">
    <div class="col-lg-4">
        <div class="card mt-5">
            <div class="card-body">
                <h4 class="card-title">Input New Number</h4>
                <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_7ciiygtc.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                <form action="{{route('verification.storenewphone')}}" method="post">
                @csrf
                    <div class="form-floating custom-form-floating form-group mb-3">
                        <input type="number" name="phone"class="form-control" id="floatingInput">
                        <label for="floatingInput">Phone Number</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Verify</button>
                        <small class="mt-2">
                            Want to back? <a href="{{route('verification.index')}}" class="text-warning">Back</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@include('user.includes.script')
</body>

</html>