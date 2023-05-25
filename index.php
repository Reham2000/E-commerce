<?php

use App\Database\Models\Brand;
use App\Database\Models\Product;
use App\Database\Models\Product_review;

    $title = "Home";
    include "layouts/header.php";
    include "layouts/navbar.php";
    
    $product = new Product;
    $brand = new Brand;
    $product_review = new Product_review;

    $brands = $brand->read()->fetch_all(MYSQLI_ASSOC);
    $products_reviews = $product_review->read()->fetch_all(MYSQLI_ASSOC);
?>
<!-- Slider Start -->
<div class="slider-area">
    <div class="slider-active owl-dot-style owl-carousel">
        <div class="single-slider ptb-240 bg-img" style="background-image:url(<?= $imagesPath ?>slider/slider1.jpg);">
            <div class="container">
                <div class="slider-content slider-animated-1">
                    <h1 class="animated text-capitalize">We have <span class="theme-color text-uppercase">best</span></h1>
                    <h1 class="animated text-capitalize">products.</h1>
                    <p>All you need you will find on our platform.</p>
                </div>
            </div>
        </div>
        <div class="single-slider ptb-240 bg-img" style="background-image:url(<?= $imagesPath ?>slider/slider2.jpg);">
            <div class="container">
                <div class="slider-content slider-animated-1">
                <h1 class="animated text-capitalize">We have <span class="theme-color text-uppercase">best</span></h1>
                    <h1 class="animated text-capitalize">products.</h1>
                    <p>All you need you will find on our platform.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Slider End -->
<!-- Product Area Start -->
<div class="product-area bg-image-1 pt-100 pb-95">
    <h2 class="text-center py-5">latast products</h2>
    <div class="container">
        <div class="row">
            <?php
                $latestProducts = $product->getLatestProducts()->fetch_all(MYSQLI_ASSOC);
                foreach($latestProducts as $latestProduct){
                ?>
            <div class="product-wrapper col-md-3 col-sm-6">
                <div class="product-img">
                    <a href="product-details.php?id=<?= $latestProduct['id']  ?>">
                        <img src="<?= $imagesPath ?>product/<?= $latestProduct['image']  ?>"
                            alt="<?= $latestProduct['name_en']?>">
                    </a>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal"
                            title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a
                                    href="product-details.php?id=<?= $latestProduct['id']  ?>"><?= $latestProduct['name_en'] ?></a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span><?= $latestProduct['price'] ?></span>
                    </div>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
    </div>
</div>
<!-- Product Area End -->

<!-- Product Area Start -->
<div class="product-area bg-image-1 pt-100 pb-95">
    <h2 class="text-center py-5">the Bestseller product</h2>
    <div class="container">
        <div class="row">
            <?php
                $bestSellerProducts = $product->getBestSellerProduct()->fetch_all(MYSQLI_ASSOC);

                foreach($bestSellerProducts as $bestSellerProduct){
                ?>
            <div class="product-wrapper col-md-3 col-sm-6">
                <div class="product-img">
                    <a href="product-details.php?id=<?= $bestSellerProduct['id'] ?>">
                        <img alt="<?= $bestSellerProduct['image'] ?>" src="<?= $imagesPath ?>product/<?= $bestSellerProduct['image'] ?>">
                    </a>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal"
                            title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a
                                    href="product-details.php?id=<?= $bestSellerProduct['id'] ?>"><?= $bestSellerProduct['image'] ?></a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span><?= $bestSellerProduct['price'] ?> EGP</span>
                    </div>
                </div>
            </div>
            <?php
                    }
                ?>
        </div>
    </div>
</div>
<!-- Product Area End -->
<!-- Banner Start -->
<div class="banner-area pt-100 pb-70">
    <div class="container">
        <div class="banner-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner img-zoom mb-30">
                        <a href="#">
                            <img src="<?= $imagesPath ?>banner/banner-1.png" alt="banner">
                        </a>
                        <div class="banner-content">
                            <h4>-50% Sale</h4>
                            <h5>Summer Vacation</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner img-zoom mb-30">
                        <a href="#">
                            <img src="<?= $imagesPath ?>banner/banner-2.png" alt="banner">
                        </a>
                        <div class="banner-content">
                            <h4>-20% Sale</h4>
                            <h5>Winter Vacation</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->
<!-- New Products Start -->
<div class="product-area gray-bg pt-90 pb-65">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Brands</h3>
            </div>
        </div>
        <div class="container">
        <div class="row">
                        <?php foreach($brands AS $brand) { ?>
                        <div class="col-3">
                            <div class="product-img">
                                <a href="shop.php?brand=<?= $brand['id'] ?>">
                                    <img alt="<?= $brand['name_en'] ?>"
                                        src="<?= $imagesPath ?>brand-logo/<?= $brand['image'] ?>">
                                </a>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
        </div>
    </div>
</div>
<!-- New Products End -->
<!-- Testimonial Area Start -->
<div class="testimonials-area bg-img pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="testimonial-active owl-carousel">
                    <?php 
                    foreach($products_reviews as $productData){
                    ?>
                    <div class="single-testimonial text-center">
                        <div class="testimonial-img">
                            <img alt="" class="w-25" src="<?= $productImagesPath . $productData['image'] ?>">
                        </div>
                        <p><?= $productData['comment'] ?></p>
                        <p><?php 
                        for($i = 1;$i <= intval($productData['rate_avg']) ;$i++){
                            echo "<i class='ion-star theme-color'></i>";
                        }
                        if(intval($productData['rate_avg']) <= 5){
                            for($i = 1 ;$i <= (5 - intval($productData['rate_avg'])) ;$i++){
                                echo "<i class='ion-star text-muted'></i>";

                            }
                        }
                        ?></p>

                        <h4><?= $productData['name'] ?></h4>
                        <h5><?= explode(' ',$productData['created_at'])[0] ?></h5>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Area End -->
<!-- News Area Start -->
<div class="blog-area bg-image-1 pt-90 pb-70">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Latest News</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="blog-single mb-30">
                    <div class="blog-thumb">
                        <a href="#"><img src="<?= $imagesPath ?>blog/blog-single-1.jpg" alt="" /></a>
                    </div>
                    <div class="blog-content pt-25">
                        <span class="blog-date">14 Sep</span>
                        <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut
                            labore et dolore</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-single mb-30">
                    <div class="blog-thumb">
                        <a href="#"><img src="<?= $imagesPath ?>blog/blog-single-2.jpg" alt="" /></a>
                    </div>
                    <div class="blog-content pt-25">
                        <span class="blog-date">20 Dec</span>
                        <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut
                            labore et dolore</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-single mb-30">
                    <div class="blog-thumb">
                        <a href="#"><img src="<?= $imagesPath ?>blog/blog-single-3.jpg" alt="" /></a>
                    </div>
                    <div class="blog-content pt-25">
                        <span class="blog-date">18 Aug</span>
                        <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut
                            labore et dolore</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- News Area End -->
<!-- Newsletter Araea Start -->
<div class="newsletter-area bg-image-2 pt-90 pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-45">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Join to our Newsletter</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-md-10 col-md-auto">
                <div class="footer-newsletter">
                    <div id="mc_embed_signup" class="subscribe-form">
                        <form
                            action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                            class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll" class="mc-form">
                                <input type="email" value="" name="EMAIL" class="email"
                                    placeholder="Your Email Address*" required>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div class="mc-news" aria-hidden="true"><input type="text"
                                        name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                <div class="submit-button">
                                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe"
                                        class="button">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Araea End -->
<?php
    include "layouts/footer.php";
    include "layouts/scripts.php";

?>