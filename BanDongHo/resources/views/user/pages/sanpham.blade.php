@extends('user.main')


@section('sanpham')

<!-- Start page sanpham -->

<div class="page_sanpham">
    <div class="container_pagesanpham">
        <div class="mid">
            <div class="slide_mid">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/user/img/slide-dongho-7.jpg" class="d-block w-100" alt="..." />
                            <div class="carousel-caption d-none d-md-block"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="/user/img/slide-dongho-5.jpg" class="d-block w-100" alt="..." />
                            <div class="carousel-caption d-none d-md-block"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://galle.vn/images/products/menufactories//original/romanson-cover_1545097622.png" class="d-block w-100" alt="..." />
                            <div class="carousel-caption d-none d-md-block"></div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>

            <div class="breadcrum">
                <nav
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg + xml, %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb"
                >
                    <ol class="breadcrumb">
                      <button class="btn-quangcao btn-trangchu">
                        Trang chủ
                      </button>
                    </ol>
                </nav>
            </div>

            <div class="mid-menu">
                <ul>
                    <li>
                        Giới tính
                        <div class="drop-menu">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="" />
                            <label for="vehicle1"> Nam</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Nữ</label><br />
                        </div>
                    </li>
                    <li>
                        Màu sắc
                        <div class="drop-menu">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="" />
                            <label for="vehicle1"> Màu den</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Màu xanh</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Màu trắng</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Màu vàng</label><br />
                        </div>
                    </li>
                    <li>
                        Hãng
                        <div class="drop-menu">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="" />
                            <label for="vehicle1"> Luxury</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Rolex</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Omega</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> Calvin Klein</label><br />
                        </div>
                    </li>
                    <li>
                        Giá tiền
                        <div class="drop-menu">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="" />
                            <label for="vehicle1"> dưới 1.000.000 </label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> 1.000.000 - 5.000.000</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> 5.000.000 - 10.000.000</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> 10.000.000 - 20.000.000</label><br />
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="" />
                            <label for="vehicle2"> trên 20.000.000</label><br />
                        </div>
                    </li>
                </ul>
                <div class="clear" style="clear: both;"></div>
            </div>

            <div class="mid-grid-sanpham">
                @foreach($product as $product)
                @csrf
                <div class="card-sanpham">
                    <div class="img-sanpham">
                    <a href="/user/pages/sanpham/chitietsanpham/{{$product->idsp}}">
                        <img src="{{asset('/imgproduct/'.$product->imgsp)}}" alt="">
                    </a>
                    </div>
                    <div class="title">
                        <h3>{{$product->namesp}}</h3>
                        <p style="float: left; margin-right: 10px;">
                            Giá:{{$product->giasp}}<sup>đ</sup>
                        </p>
                        <del>{{$product->giagoc}}<sup>đ</sup></del>
                        <div style="clear: both;"></div>
                        <form action="/user/pages/sanpham/cart/{{$product->idsp}}" method="POST">
                            @csrf
                            <input type="number" name="soluong" min="1" max="10" value="1" />
                            <input class="submit_cart" type="submit" name="addcart" value="Ðặt hàng" />
                            <!-- <a href="./getIdCart.php?key=23" class="product_item_cart_btn">
                                      <span>THÊM VÀO GIỎ HÀNG</span>
                            </a> -->
                            <input type="hidden" name="namesp" value="{{$product->namesp}}" />
                            <input type="hidden" name="idsp" value="{{$product->idsp}}" />
                            <input type="hidden" name="giasp" value=" {{$product->giasp}}" />
                            <input type="hidden" name="giagoc" value=" {{$product->giagoc}}" />
                            <input type="hidden" name="chitietsp" value=" {{$product->chitietsp}}" />
                            <input type="hidden" name="iduser" value="{{Auth::user()->id}}" />
                            <input type="hidden" name="imgsp" value="{{($product->imgsp)}}" />
                        </form>

                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                @endforeach
            </div>
        </div>
    </div>

</div>
  <!-- End page sanpham -->
@endsection
