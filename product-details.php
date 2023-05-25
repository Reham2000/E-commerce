<?php

use App\Database\Models\Product;

$title = "Product Details";
include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";
$_404 = "header('location:layouts/errors/404.php')";

$productOpject = new Product;
if ($_GET) {
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $productRes = $productOpject->setId($_GET['id'])->getProductReview();

            if ($productRes->num_rows == 1) {
                $product_rev = $productRes->fetch_object();
                // print_r($product_rev);die;

            } else {
                $_404;
            }
            $productResult = $productOpject->setId($_GET['id'])->getProduct();
            if ($productResult->num_rows == 1) {
                $product = $productResult->fetch_assoc();
                // print_r($product);die;

            } else {
                $_404;
            }
        }
        if(isset($_SESSION['user'])){
            if (isset($_POST['rating']) && isset($_POST['comment'])) {
                $result = $productOpject->setUser_id($_SESSION['user']->id)->setId($_GET['id'])->setRate($_POST['rating'])->setComment($_POST['comment'])->addReview();
            }
        }else{
            header("location:login.php");die;
        }
    }
}



?>
<style>
    .star-rating {
        /* border:solid 1px #ccc; */
        display: flex;
        flex-direction: row-reverse;
        font-size: 2.5em;
        justify-content: space-around;
        padding: 10px .2em;
        text-align: center;
        width: 5em;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
    }

    .star-rating :checked~label {
        color: #f90;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #fc0;
    }
</style>
<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="<?= $imagesPath ?>product/<?= $product['image'] ?>" data-zoom-image="<?= $imagesPath ?>product/<?= $product['image'] ?>" alt="zoom" />
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $product['name_en'] ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php for ($i = 1; $i <= $product_rev->rate_avg; $i++) { ?>
                                <i class="ion-android-star-outline theme-star"></i>
                            <?php } ?>
                            <?php for ($i = 1; $i <= 5 - $product_rev->rate_avg; $i++) { ?>
                                <i class="ion-android-star-outline"></i>
                            <?php } ?>
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?= $product_rev->rate_count ?> Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $product['price'] ?></span>
                    <div class="in-stock">
                        <?php
                        if ($product['quentity'] == 0) {
                            $msg = "Not Avilale Now";
                            $color = 'danger';
                        } elseif ($product['quentity'] <= 5) {
                            $msg = "In Stock ({$product['quentity']})";
                            $color = 'warning';
                        } else {
                            $msg = "In Stock";
                            $color = 'success';
                        }
                        ?>
                        <p>Available: <span class="text-<?= $color ?>"><?= $msg ?></span></p>
                    </div>
                    <p><?= $product['details_en'] ?></p>

                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                        </div>
                        <div class="shop-list-cart-wishlist">
                            <a title="Add To Cart" href="#">
                                <i class="icon-handbag"></i>
                            </a>
                            <a title="Wishlist" href="#">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title">Categories:</li>
                            <li><a href="shop.php?category=<?= $product['category_id'] ?>"><?= $product['category_name'] ?>,</a>
                            </li>
                            <li><a href="shop.php?subcategory=<?= $product['subcategory_id'] ?>"><?= $product['subcategory_name'] ?>,</a>
                            </li>
                            <li><a href="shop.php?brand=<?= $product['brand_id'] ?>"><?= $product['brand_name'] ?>,</a>
                            </li>

                        </ul>
                    </div>

                    <div class="pro-dec-social">
                        <ul>
                            <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                            <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                            <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a>
                            </li>
                            <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details2">Tags</a>
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p><?= $product['details_en'] ?> </p>


                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            <li class="categories-title">Categories:</li>
                            <li><a href="shop.php?category=<?= $product['category_id'] ?>"><?= $product['category_name'] ?>,</a>
                            </li>
                            <li><a href="shop.php?subcategory=<?= $product['subcategory_id'] ?>"><?= $product['subcategory_name'] ?>,</a>
                            </li>
                            <li><a href="shop.php?brand=<?= $product['brand_id'] ?>"><?= $product['brand_name'] ?>,</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">
                        <?php
                        if ($productOpject->allReviews()->num_rows > 0) {
                            foreach ($productOpject->allReviews()->fetch_all(MYSQLI_ASSOC) as $review) {
                        ?>
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php for ($i = 1; $i <= $review['rate']; $i++) { ?>
                                                <i class="ion-star theme-color"></i>
                                            <?php } ?>
                                            <?php for ($i = 1; $i <= 5 - $review['rate']; $i++) { ?>
                                                <i class="ion-android-star-outline"></i>
                                            <?php } ?>

                                            <span>(<?= $review['rate'] ?>)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3><?= $review['full_name'] ?></h3>
                                            <span><?= $review['created_at'] ?></span>
                                        </div>
                                    </div>
                                    <p><?= $review['comment'] ?></p>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="text-warning text-center">There is no review to show</div>
                        <?php } ?>
                    </div>
                    <div class="ratting-form-wrapper">
                        <h3>Add your Comments :</h3>
                        <div class="ratting-form">
                            <form method="POST">
                                <div class="star-box">
                                    <h2>Rating:</h2>

                                    <div class="star-rating">
                                        <input type="radio" id="5-stars" name="rating" value="5" />
                                        <label for="5-stars" class="star">&#9733;</label>
                                        <input type="radio" id="4-stars" name="rating" value="4" />
                                        <label for="4-stars" class="star">&#9733;</label>
                                        <input type="radio" id="3-stars" name="rating" value="3" />
                                        <label for="3-stars" class="star">&#9733;</label>
                                        <input type="radio" id="2-stars" name="rating" value="2" />
                                        <label for="2-stars" class="star">&#9733;</label>
                                        <input type="radio" id="1-star" name="rating" value="1" />
                                        <label for="1-star" class="star">&#9733;</label>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="rating-form-style form-submit">
                                            <textarea name="comment" placeholder="Comment"></textarea>
                                            <input type="submit" value="add review">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "layouts/footer.php";
include "layouts/scripts.php";

?>