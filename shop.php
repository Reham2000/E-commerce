<?php

use App\Database\Models\Brand;
use App\Database\Models\Category;
use App\Database\Models\Product;
use App\Database\Models\Subcategory;

$title = "Shop";
include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";


$productOpject = new Product;
$_404 ="header('location:layouts/errors/404.php')";

if ($_GET) {
  if (isset($_GET['brand'])) {
    if (is_numeric($_GET['brand'])) {
      $brandOpject = new Brand;
      $brandsResult = $brandOpject->setId($_GET['brand'])->getBrand();
      if ($brandsResult->num_rows == 1) {
        $productOpject->setBrand_id($_GET['brand']);
        $products = $productOpject->getProductsByBrandId()->fetch_all(MYSQLI_ASSOC);
      } else {
        $_404;
        die;
      }
    } else {
      $_404;
      die;
    }
  } elseif (isset($_GET['category'])) {
    if (is_numeric($_GET['category'])) {
      $categoryOpject = new Category;
      $categoriesResult = $categoryOpject->setId($_GET['category'])->getCategory();
      if ($categoriesResult->num_rows == 1) {
        $productOpject->setCategory_id($_GET['category']);
        $products = $productOpject->getProductsByCategoryId()->fetch_all(MYSQLI_ASSOC);
      } else {
        $_404;
        die;
      }
    } else {
      $_404;
      die;
    }
  } elseif (isset($_GET['subcategory'])) {
    if (is_numeric($_GET['subcategory'])) {
      $subcategoryOpject = new Subcategory;
      $subcategoriesResult = $subcategoryOpject->setId($_GET['subcategory'])->getSubcategory();
      if ($subcategoriesResult->num_rows == 1) {
        $productOpject->setsubCategory_id($_GET['subcategory']);
        $products = $productOpject->getProductsBySubcategoryId()->fetch_all(MYSQLI_ASSOC);
      } else {
        $_404;
        die;
      }
    } else {
      $_404;
      die;
    }
  } else {
    $_404;
    die;
  }
} else {
  $products = $productOpject->read()->fetch_all(MYSQLI_ASSOC);
}




?>
<!-- Shop Page Area Start -->
<div class="shop-page-area ptb-100">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="shop-topbar-wrapper">
          <div class="shop-topbar-left">
            <ul class="view-mode">
              <li class="active">
                <a href="#product-grid" data-view="product-grid"><i class="fa fa-th"></i></a>
              </li>
              <li>
                <a href="#product-list" data-view="product-list"><i class="fa fa-list-ul"></i></a>
              </li>
            </ul>
            <p>Showing 1 - 20 of 30 results</p>
          </div>
          <div class="product-sorting-wrapper">
            <div class="product-shorting shorting-style">
              <label>View:</label>
              <select>
                <option value="">20</option>
                <option value="">23</option>
                <option value="">30</option>
              </select>
            </div>
            <div class="product-show shorting-style">
              <label>Sort by:</label>
              <select>
                <option value="">Default</option>
                <option value="">Name</option>
                <option value="">price</option>
              </select>
            </div>
          </div>
        </div>
        <div class="grid-list-product-wrapper">
          <div class="product-grid product-view pb-20">
            <div class="row">
              <?php
              if ($productOpject->read()->num_rows > 0) {
                foreach ($products as $product) {
              ?>
                  <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                    <div class="product-wrapper">
                      <div class="product-img">
                        <a href="product-details.php?id=<?= $product['id'] ?>">
                          <img alt="<?= $product['name_en'] ?>" src="<?= $imagesPath ?>product/<?= $product['image']?>" />
                        </a>
                        <div class="product-action">
                          <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                          </a>
                          <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                          </a>
                          <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                          </a>
                        </div>
                      </div>
                      <div class="product-content text-left">
                        <div class="product-hover-style">
                          <div class="product-title">
                            <h4>
                              <a href="product-details.php?id=<?= $product['id'] ?>"><?= $product['name_en'] ?></a>
                            </h4>
                          </div>
                          <div class="cart-hover">
                            <h4>
                              <a href="product-details.php">+ Add to cart</a>
                            </h4>
                          </div>
                        </div>
                        <div class="product-price-wrapper">
                          <span><?= $product['price'] ?></span>
                        </div>
                      </div>
                      <div class="product-list-details">
                        <h4>
                          <a href="product-details.php?id=<?= $product['id'] ?>"><?= $product['name_en'] ?></a>
                        </h4>
                        <div class="product-price-wrapper">
                          <span><?= $product['price'] ?></span>
                        </div>
                        <p>
                          <?= $product['details_en'] ?>
                        </p>
                        <div class="shop-list-cart-wishlist">
                          <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                          <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                          <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                }
              } else { ?>
                <div class="bg-warning text-center">No products to show !</div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="pagination-total-pages">
            <div class="pagination-style">
              <ul>
                <li>
                  <a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a>
                </li>
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">10</a></li>
                <li>
                  <a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="total-pages">
              <p>Showing 1 - 20 of 30 results</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
          <div class="shop-widget">
            <h4 class="shop-sidebar-title">Shop By Categories</h4>
            <div class="shop-catigory">
              <ul id="faq">
                <li>
                  <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-1">Morning Tea <i class="ion-ios-arrow-down"></i></a>
                  <ul id="shop-catigory-1" class="panel-collapse collapse show">
                    <li><a href="#">Green</a></li>
                    <li><a href="#">Herbal</a></li>
                    <li><a href="#">Loose </a></li>
                    <li><a href="#">Mate</a></li>
                    <li><a href="#">Organic</a></li>
                  </ul>
                </li>
                <li>
                  <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-2">Tea Trends<i class="ion-ios-arrow-down"></i></a>
                  <ul id="shop-catigory-2" class="panel-collapse collapse">
                    <li><a href="#">Pu'Erh</a></li>
                    <li><a href="#">Black</a></li>
                    <li><a href="#">White</a></li>
                    <li><a href="#">Yellow Tea</a></li>
                    <li><a href="#">Puer Tea</a></li>
                  </ul>
                </li>
                <li>
                  <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-3">Most Tea Map <i class="ion-ios-arrow-down"></i></a>
                  <ul id="shop-catigory-3" class="panel-collapse collapse">
                    <li><a href="#">Green Tea</a></li>
                    <li><a href="#">Oolong Tea</a></li>
                    <li><a href="#">Black Tea</a></li>
                    <li><a href="#">Pu'erh Tea </a></li>
                    <li><a href="#">Dark Tea</a></li>
                  </ul>
                </li>
                <li><a href="#">Herbal Tea</a></li>
                <li><a href="#">Rooibos Tea</a></li>
                <li><a href="#">Organic Tea</a></li>
              </ul>
            </div>
          </div>
          <div class="shop-price-filter mt-40 shop-sidebar-border pt-35">
            <h4 class="shop-sidebar-title">Price Filter</h4>
            <div class="price_filter mt-25">
              <span>Range: $100.00 - 1.300.00 </span>
              <div id="slider-range"></div>
              <div class="price_slider_amount">
                <div class="label-input">
                  <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                </div>
                <button type="button">Filter</button>
              </div>
            </div>
          </div>
          <div class="shop-widget mt-40 shop-sidebar-border pt-35">
            <h4 class="shop-sidebar-title">By Brand</h4>
            <div class="sidebar-list-style mt-20">
              <ul>
                <li><input type="checkbox" /><a href="#">Green </a></li>
                <li><input type="checkbox" /><a href="#">Herbal </a></li>
                <li><input type="checkbox" /><a href="#">Loose </a></li>
                <li><input type="checkbox" /><a href="#">Mate </a></li>
                <li><input type="checkbox" /><a href="#">Organic </a></li>
                <li><input type="checkbox" /><a href="#">White </a></li>
                <li>
                  <input type="checkbox" /><a href="#">Yellow Tea </a>
                </li>
                <li><input type="checkbox" /><a href="#">Puer Tea </a></li>
              </ul>
            </div>
          </div>
          <div class="shop-widget mt-40 shop-sidebar-border pt-35">
            <h4 class="shop-sidebar-title">By Color</h4>
            <div class="sidebar-list-style mt-20">
              <ul>
                <li><input type="checkbox" /><a href="#">Black </a></li>
                <li><input type="checkbox" /><a href="#">Blue </a></li>
                <li><input type="checkbox" /><a href="#">Green </a></li>
                <li><input type="checkbox" /><a href="#">Grey </a></li>
                <li><input type="checkbox" /><a href="#">Red</a></li>
                <li><input type="checkbox" /><a href="#">White </a></li>
                <li><input type="checkbox" /><a href="#">Yellow </a></li>
              </ul>
            </div>
          </div>
          <div class="shop-widget mt-40 shop-sidebar-border pt-35">
            <h4 class="shop-sidebar-title">Compare Products</h4>
            <div class="compare-product">
              <p>You have no item to compare.</p>
              <div class="compare-product-btn">
                <span>Clear all </span>
                <a href="#">Compare <i class="fa fa-check"></i></a>
              </div>
            </div>
          </div>
          <div class="shop-widget mt-40 shop-sidebar-border pt-35">
            <h4 class="shop-sidebar-title">Popular Tags</h4>
            <div class="shop-tags mt-25">
              <ul>
                <li><a href="#">Green</a></li>
                <li><a href="#">Oolong</a></li>
                <li><a href="#">Black</a></li>
                <li><a href="#">Pu'erh</a></li>
                <li><a href="#">Dark </a></li>
                <li><a href="#">Special</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Shop Page Area End -->

<?php
include "layouts/footer.php";
include "layouts/scripts.php";

?>