@extends('user.layout.master')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('product/' . $products->image) }}" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $products->name }}</h4>
                            <span class="text-danger"> (Only left {{ $products->availabel_item }} items) </span>
                            <p class="mb-3">Category: {{ $products->category_name }}</p>
                            <h5 class="fw-bold mb-3">{{ $products->price }} MMK</h5>
                            <div class="d-flex mb-4">
                                <span>
                                    @php $stars= number_format($rating) @endphp

                                    @for ($i = 1; $i <= $stars; $i++)
                                        <i class="fa fa-star text-secondary"></i>
                                    @endfor

                                    @for ($j = $stars+1 ; $j <= 5 ; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </span>

                                <span class="ms-3">
                                     <i class="fa-solid fa-eye"></i>
                                     {{-- @if ( Auth::user()->id != $view_count->user_id && $products->id != $view_count->post_id ) --}}
                                        {{$view_count}}
                                     {{-- {{ -- @endif --}}

                                </span>

                            </div>
                            <p class="mb-4">{{ $products->description }}</p>
                            {{-- <p class="mb-4">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish</p> --}}
                            <form action="{{ route('product#addToCart') }}" method="post">
                                @csrf
                                <input type="hidden" name="userId" id="" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="productId" id="" value="{{ $products->id }}">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="count"
                                        class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>

                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"></i><i
                                        class="fa-solid fa-star text-secondary"></i> Rate this product</button>
                            </form>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rate this product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('product#rating')}}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <input type="hidden" name="productId" id="" value="{{$products->id}}">

                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            {{$user_rating}}
                                                            @if ($user_rating == 0)
                                                                <input type="radio" value="1" name="productRating" checked id="rating1">
                                                                <label for="rating1" class="fa fa-star"></label>
                                                                <input type="radio" value="2" name="productRating" id="rating2">
                                                                <label for="rating2" class="fa fa-star"></label>
                                                                <input type="radio" value="3" name="productRating" id="rating3">
                                                                <label for="rating3" class="fa fa-star"></label>
                                                                <input type="radio" value="4" name="productRating" id="rating4">
                                                                <label for="rating4" class="fa fa-star"></label>
                                                                <input type="radio" value="5" name="productRating" id="rating5">
                                                                <label for="rating5" class="fa fa-star"></label>
                                                            @else
                                                                 @php $userRating = number_format ($user_rating) @endphp

                                                                 @for ( $i = 1 ; $i <= $user_rating  ; $i++)
                                                                    <input type="radio" value="{{$i}}" name="productRating" checked id="rating{{$i}}">
                                                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                                                @endfor

                                                                @for ( $j = $userRating+1; $j <= 5 ; $j++)
                                                                    <input type="radio" value="{{$j}}" name="productRating" id="rating{{$j}}">
                                                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                                                @endfor

                                                            @endif



                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Rating</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Customer Comments <small
                                            class="btn btn-sm rounded btn-secondary">{{ count($comment) }}</small> </button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{{ $products->description }} </p>

                                    {{-- <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    @foreach ($comment as $item)
                                        <div class="d-flex">
                                            <img src="{{ asset($item->user_profile != null ? 'profile/' . $item->user_profile : 'admin/img/undraw_profile.svg') }}"
                                                class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;"
                                                alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">
                                                    {{ $item->created_at->format('j-F-Y h:m') }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>{{ $item->user_name }}</h5>
                                                    @if ($item->user_id == Auth::user()->id)
                                                    <a href="{{route('delete#comment',$item->id)}}">
                                                      <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></i></button>
                                                    </a>
                                                    @endif
                                                </div>
                                                <p>{{ $item->message }} </p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('product#comment') }}" method="post">
                            @csrf

                            <input type="hidden" name="productId" value="{{ $products->id }}">
                            <h4 class="mb-5 fw-bold">Leave a Comment</h4>
                            <div class="row g-4">
                                {{-- <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" placeholder="Yur Name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" placeholder="Your Email *">
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="comment" id="" class="form-control border-0 shadow-sm" cols="10" rows="8"
                                            placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end  mb-5">
                                        <button type="submit"
                                            class="btn btn-sm border border-secondary text-primary rounded-pill px-4 py-3">
                                            Post Comment</button type="submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                                            <span>(2)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                                            <span>(8)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div> --}}
            </div>
            @if (count($productList) != 0)
                <h1 class="fw-bold mb-0">Related products</h1>
            @endif
            {{-- <div class="vesitable">
                <div class="col-3 @if (count($productList) >= 3) owl-carousel vegetable-carousel justify-content-center @endif">
                    @foreach ($productList as $item)
                        @if ($products->id != $item->id)
                            <div class="border border-primary rounded position-relative vesitable-item" style="height: 550px">
                                <div class="vesitable-img">
                                    <img src="{{asset('product/'.$item->image)}}" class="img-fluid w-100 rounded-top" style="height:300px" alt="">
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{$item->category_name}}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{$item->name}}</h4>
                                    <p>{{ Str::words ($item->description, 15, '...') }}</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">{{$item->price}} MMK</p>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Single Product End -->
    {{-- <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="shop-detail.html" class="nav-item nav-link active">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="cart.html" class="dropdown-item">Cart</a>
                                <a href="chackout.html" class="dropdown-item">Chackout</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a>
                        <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End --> --}}
@endsection
