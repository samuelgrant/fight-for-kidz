@extends('layouts.app')

@section('content')
  <div class="heading-container push-down mb-0">
    <h1 class="text-white text-center">2018 Matchups</h1>>
  </div>

  <div id="contender-carousel" class="carousel slide" data-ride="carousel">

    <ul class="carousel-indicators">
      <li data-target="#contender-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#contender-carousel" data-slide-to="1"></li>
      <li data-target="#contender-carousel" data-slide-to="2"></li>
    </ul>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
              <div class="row matchup">
                <div class="col-lg-5 contender-div contender-red">
                  <div class="contender-img">
                    <img src="img/unknown2.png" class="img-fluid">
                  </div>
                  <div class="contender-info">
                      <h1 class="">TBC</h1>  
                      <a href="#signup" class="js-scroll-trigger"><h3 class="text-white text-center tbc-signup">Sign Up!</h3></a>                  
                    </div>
                </div>
                <div class="col-lg-2 align-self-center">
                  <h1 class="text-center text-white big-VS">VS</h1>
                </div>
                <div class="col-lg-5 contender-div contender-blue">
                  <div class="contender-img">
                    <img src="img/unknown1.png" class="img-fluid">
                  </div>
                  <div class="contender-info">
                    <h1 class="">TBC</h1>
                    <a href="#signup" class="js-scroll-trigger"><h3 class="text-white text-center tbc-signup">Sign Up!</h3></a>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
      <div class="carousel-item">
        <div class="container">
          <div class="row matchup">
            <div class="col-lg-5 contender-div contender-red">
              <div class="contender-img">
                <img src="img/cox.png" class="img-fluid">
              </div>
              <div class="contender-info">
                <h4>Shannon
                  <br>"The SuperCannon"
                  <br>Cox</h4>
                <table>
                  <tr>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Reach</th>
                  </tr>
                  <tr>
                    <td>34</td>
                    <td>101kg</td>
                    <td>184cm</td>
                    <td>84cm</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 align-self-center">
              <h1 class="text-center text-white big-VS">VS</h1>
            </div>
            <div class="col-lg-5 contender-div contender-blue">
              <div class="contender-img">
                <img src="img/hill.png" class="img-fluid">
              </div>
              <div class="contender-info">
                <h4>James
                  <br>"The Pill"
                  <br> Hill</h4>
                <table>
                  <tr>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Reach</th>
                  </tr>
                  <tr>
                    <td>36</td>
                    <td>101kg</td>
                    <td>184cm</td>
                    <td>84cm</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container">
          <div class="row matchup">
            <div class="col-lg-5 contender-div contender-red">
              <div class="contender-img">
                <img src="img/anderson.png" class="img-fluid">
              </div>
              <div class="contender-info">
                <h4>Megan Anderson</h4>
                <table>
                  <tr>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Reach</th>
                  </tr>
                  <tr>
                    <td>29</td>
                    <td>81kg</td>
                    <td>178cm</td>
                    <td>84cm</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 align-self-center">
              <h1 class="text-center text-white big-VS">VS</h1>
            </div>
            <div class="col-lg-5 contender-div contender-blue">
              <div class="contender-img">
                <img src="img/mcminn.png" class="img-fluid">
              </div>
              <div class="contender-info">
                <h4>Kendall McMinn</h4>
                <table>
                  <tr>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Reach</th>
                  </tr>
                  <tr>
                    <td>27</td>
                    <td>68kg</td>
                    <td>172cm</td>
                    <td>84cm</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#contender-carousel" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#contender-carousel" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
@endsection
