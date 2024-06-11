<!doctype html>
<html lang="en">

<head>
    <title>@yield('title') |Deals69</title>
 <link rel="icon" href="{{ asset('front/assets/images/icons.png') }}" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    
  
<meta name='impact-site-verification' value='de4ec733-7974-4b7d-a7aa-611819cb6e0f'>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NJNM88GL');</script>
<!-- End Google Tag Manager -->
    
    <style>
    
nav{

  background-color:rgb(93, 25, 130);
}
section{
background-color:rgb(87, 18, 124);
}


}
  .container {
      display: flex;
      justify-content: center; /* Center contents horizontally */
      align-items: center;
    }
    .form-container {
      max-width: 600px; /* Adjust max-width as needed */
      width: 100%;
    }
    .form-container form {
        right:200px;
      display: flex;
      justify-content: center; /* Center contents horizontally */
      align-items: center;
    }
    .social-icons a {
      color:white; /* Change icon color as needed */
      margin-left: 10px; /* Adjust margin between icons as needed */
      font-size: 25px; /* Adjust icon size as needed */
    }

</style>
</head>

<body>


<x-component-name/>

<div class="container"> 
    <!-- Display Stores -->
    <h3>Search Results</h3>
    <div class="main_content">
        <div class="container">
            <div class="row mt-3">
                @if (isset($stores) && $stores->isEmpty())
                    <div class="col-12">
                        <h1>No stores found.</h1>
                    </div>
                @elseif(isset($stores))
                    @foreach ($stores as $store)
                        <div class="col-12 col-lg-3">
                            @if ($store->name)
                                <a href="{{ route('store_details', ['name' => Str::slug($store->name)]) }}" class="text-decoration-none">
                            @else
                                <a href="javascript:;" class="text-decoration-none">
                            @endif
                                    <div class="card shadow">
                                        <div class="card-body">
                                            @if ($store->store_image)
                                                <img src="{{ asset('uploads/store/' . $store->store_image) }}" width="100%" alt="{{ $store->name }}">
                                            @else
                                                <img src="{{ asset('front/assets/images/no-image-found.jpg') }}" width="100%" alt="No Image Found">
                                            @endif
                                            <h5 class="card-title mt-3 mx-2">{{ isset($store->name) ? $store->name : "Title not found" }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

        
  
    <br><br><br><br><br><br>
    
    <x-footer/>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="{{ asset('front/assets/js/script.js') }}"></script>
    @yield('scripts')
</body>

</html>
