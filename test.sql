CREATE VIEW product_details AS(
    SELECT
        products.*,
        brands.name_en AS `brand_name`,
        categories.id AS `category_id`,
        categories.name_en AS `category_name`,
        subcategories.name_en AS `subcategory_name`,
        COUNT(reviews.product_id) AS `rate_count`,
        AVG(reviews.rate) AS `rate_avg`,
        reviews.comment
    FROM
        products
    LEFT JOIN subcategories ON subcategories.id = products.subcategory_id
    LEFT JOIN categories ON categories.id = subcategories.category_id
    LEFT JOIN brands ON products.brand_id = brands.id
    LEFT JOIN reviews ON products.id += reviews.product_id
)


-- ------ product_data -------
create VIEW product_data as (
SELECT
    products.*,
    brands.name_en AS "brand_name",
    subcategories.name_en AS `subcategory_name`,
    categories.id AS `category_id`,
        categories.name_en AS `category_name`
FROM
    `products`
JOIN `brands` ON products.brand_id = brands.id
JOIN `subcategories` ON products.subcategory_id = subcategories.id
JOIN `categories` ON categories.id = subcategories.id


WHERE products.status = 1

)