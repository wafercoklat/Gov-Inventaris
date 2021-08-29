<html lang="{{ app()->getLocale() }}">

@include('components.head-meta')

<body>
    <div class="wrapper">

        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>
        @include('components.header')

        <div class="container-fluid">
            <div class="row">
                @include('components.side')
{{-- ------------------------------------------------------------------------------ --}}
                
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">  Error </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item active"> Error </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
    <div class="row">   
    <div class="col-xl-12">     
      <div class="card card-statistics mb-30"> 
        <div class="card-body position-relative">
          <div class="error">
           <h1>404</h1>
           <h2>error</h2>
        </div>
      </div>  
     <img class="img-fluid error-image" src="{{ Asset ('vendors/images/error.png')}}" alt="">
    </div>
{{-- ------------------------------------------------------------------------------ --}}
            </div>
        </div>
    </div>
    
@include('components.foot-script')
</body>
</html>