<?php
  /*Template name: homepage */
 ?>
 <?php get_header() ?>
 <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/homepage.css?ver=<?= rand(100, 999)?>"/>
<title>Trang chủ</title>
<div class="homepage">
  <div class="section-1">
    <div class="banner">
      <img src="<?= get_field('banner')['url'] ?>" alt="">
    </div>
  </div>
  <div class="section-2">
    <p class="title">Giới tính</p>
    <?php // Lấy đối tượng danh mục cha (parent category) có slug là 'sex'
      $parent_category = get_term_by('slug', 'sex', 'product_cat');

      // Kiểm tra nếu danh mục cha tồn tại
      if ($parent_category) {
          // Lấy tất cả danh mục con của danh mục cha có slug là 'sex'
          $child_categories = get_terms(array(
              'taxonomy'   => 'product_cat', // Taxonomy của WooCommerce
              'parent'     => $parent_category->term_id, // ID của danh mục cha
              'hide_empty' => false, // Hiển thị danh mục không có sản phẩm
          ));

          // Kiểm tra nếu có danh mục con
          if (!empty($child_categories) && !is_wp_error($child_categories)) {
              echo '<ul>';
              foreach ($child_categories as $category) {
                  // Lấy ảnh đại diện của danh mục con
                  $image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                  $image_url = wp_get_attachment_url($image_id);

                  // Lấy link đến trang danh mục con
                  $category_link = get_term_link($category);

                  // Hiển thị danh mục con với ảnh và link
                  echo '<li>';
                  echo '<a href="' . esc_url($category_link) . '">';
                  if ($image_url) {
                      echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '" style="max-width: 294px; height: auto;" />';
                  }
                  echo '<p class="category">' . esc_html($category->name) . '</p>';
                  echo '</a>';
                  echo '</li>';
              }
              echo '</ul>';
          } else {
              echo 'Không có danh mục con nào.';
          }
      } else {
          echo 'Danh mục cha không tồn tại.';
      }
 ?>

  </div>
  <div class="section-3">
      <p class="title">Thương hiệu</p>
      <div class="nike">
        <h1>Nike</h1>
        <div class="brand">
            <?php
            // ID của category con "Nike"
            $category_slug = 'nike'; // Hoặc ID nếu bạn biết
            $number_of_products = 4;

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $number_of_products,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug', // Hoặc 'term_id' nếu bạn muốn dùng ID
                        'terms'    => $category_slug,
                    ),
                ),
                'orderby' => 'date',
                'order'   => 'DESC',
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    global $product;

                    // Lấy giá
                    if ($product->is_type('variable')) {
                        $prices = $product->get_variation_prices();
                        $regular_price = !empty($prices['regular_price']) ? min($prices['regular_price']) : 0;
                        $sale_price = !empty($prices['sale_price']) ? min($prices['sale_price']) : null;
                    } else {
                        $regular_price = $product->get_regular_price();
                        $sale_price = $product->get_sale_price();
                    }

                    // Lấy category con
                    $product_cats = wp_get_post_terms(get_the_ID(), 'product_cat');
                    $categories = array(
                        'product' => '',
                        'sex' => '',
                    );

                    foreach ($product_cats as $cat) {
                        $parent = get_term($cat->parent, 'product_cat');
                        if ($parent && $parent->slug === 'product') {
                            $categories['product'] = $cat->name; // Lấy tên category con của "Loại giày"
                        }
                        if ($parent && $parent->slug === 'sex') {
                            $categories['sex'] = $cat->name; // Lấy tên category con của "Giới tính"
                        }
                    }

                    // Hiển thị sản phẩm
                    ?>
                    <div class="product">
                        <a class="link-product" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="categories">
                                <?php
                                // Hiển thị loại giày và giới tính nếu có
                                echo !empty($categories['product']) ? $categories['product'] : '';
                                echo (!empty($categories['product']) && !empty($categories['sex'])) ? ' ' : '';
                                echo !empty($categories['sex']) ? $categories['sex'] : '';
                                ?>
                            </p>
                            <p class="price">
                                <?php if (!empty($sale_price) && $sale_price < $regular_price) : ?>
                                    <span class="regular-price" style="text-decoration: line-through; color: #999;">
                                        <?php echo wc_price($regular_price); ?>
                                    </span>
                                    <span class="sale-price" style="color: #f00; font-weight: bold;">
                                        <?php echo wc_price($sale_price); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="regular-price">
                                        <?php echo wc_price($regular_price); ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo 'No products found in this category.';
            }
            ?>
        </div>
      </div>
      <div class="Adidas">
        <h1>Adidas</h1>
        <div class="brand">
            <?php
            // ID của category con "Nike"
            $category_slug = 'adidas'; // Hoặc ID nếu bạn biết
            $number_of_products = 4;

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $number_of_products,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug', // Hoặc 'term_id' nếu bạn muốn dùng ID
                        'terms'    => $category_slug,
                    ),
                ),
                'orderby' => 'date',
                'order'   => 'DESC',
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    global $product;

                    // Lấy giá
                    if ($product->is_type('variable')) {
                        $prices = $product->get_variation_prices();
                        $regular_price = !empty($prices['regular_price']) ? min($prices['regular_price']) : 0;
                        $sale_price = !empty($prices['sale_price']) ? min($prices['sale_price']) : null;
                    } else {
                        $regular_price = $product->get_regular_price();
                        $sale_price = $product->get_sale_price();
                    }

                    // Lấy category con
                    $product_cats = wp_get_post_terms(get_the_ID(), 'product_cat');
                    $categories = array(
                        'product' => '',
                        'sex' => '',
                    );

                    foreach ($product_cats as $cat) {
                        $parent = get_term($cat->parent, 'product_cat');
                        if ($parent && $parent->slug === 'product') {
                            $categories['product'] = $cat->name; // Lấy tên category con của "Loại giày"
                        }
                        if ($parent && $parent->slug === 'sex') {
                            $categories['sex'] = $cat->name; // Lấy tên category con của "Giới tính"
                        }
                    }

                    // Hiển thị sản phẩm
                    ?>
                    <div class="product">
                        <a class="link-product" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="categories">
                                <?php
                                // Hiển thị loại giày và giới tính nếu có
                                echo !empty($categories['product']) ? $categories['product'] : '';
                                echo (!empty($categories['product']) && !empty($categories['sex'])) ? ' ' : '';
                                echo !empty($categories['sex']) ? $categories['sex'] : '';
                                ?>
                            </p>
                            <p class="price">
                                <?php if (!empty($sale_price) && $sale_price < $regular_price) : ?>
                                    <span class="regular-price" style="text-decoration: line-through; color: #999;">
                                        <?php echo wc_price($regular_price); ?>
                                    </span>
                                    <span class="sale-price" style="color: #f00; font-weight: bold;">
                                        <?php echo wc_price($sale_price); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="regular-price">
                                        <?php echo wc_price($regular_price); ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo 'No products found in this category.';
            }
            ?>
        </div>
      </div>
      <div class="biti">
        <h1>Biti's</h1>
        <div class="brand">
            <?php
            // ID của category con "Nike"
            $category_slug = 'bitis'; // Hoặc ID nếu bạn biết
            $number_of_products = 4;

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $number_of_products,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug', // Hoặc 'term_id' nếu bạn muốn dùng ID
                        'terms'    => $category_slug,
                    ),
                ),
                'orderby' => 'date',
                'order'   => 'DESC',
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    global $product;

                    // Lấy giá
                    if ($product->is_type('variable')) {
                        $prices = $product->get_variation_prices();
                        $regular_price = !empty($prices['regular_price']) ? min($prices['regular_price']) : 0;
                        $sale_price = !empty($prices['sale_price']) ? min($prices['sale_price']) : null;
                    } else {
                        $regular_price = $product->get_regular_price();
                        $sale_price = $product->get_sale_price();
                    }

                    // Lấy category con
                    $product_cats = wp_get_post_terms(get_the_ID(), 'product_cat');
                    $categories = array(
                        'product' => '',
                        'sex' => '',
                    );

                    foreach ($product_cats as $cat) {
                        $parent = get_term($cat->parent, 'product_cat');
                        if ($parent && $parent->slug === 'product') {
                            $categories['product'] = $cat->name; // Lấy tên category con của "Loại giày"
                        }
                        if ($parent && $parent->slug === 'sex') {
                            $categories['sex'] = $cat->name; // Lấy tên category con của "Giới tính"
                        }
                    }

                    // Hiển thị sản phẩm
                    ?>
                    <div class="product">
                        <a class="link-product" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="categories">
                                <?php
                                // Hiển thị loại giày và giới tính nếu có
                                echo !empty($categories['product']) ? $categories['product'] : '';
                                echo (!empty($categories['product']) && !empty($categories['sex'])) ? ' ' : '';
                                echo !empty($categories['sex']) ? $categories['sex'] : '';
                                ?>
                            </p>
                            <p class="price">
                                <?php if (!empty($sale_price) && $sale_price < $regular_price) : ?>
                                    <span class="regular-price" style="text-decoration: line-through; color: #999;">
                                        <?php echo wc_price($regular_price); ?>
                                    </span>
                                    <span class="sale-price" style="color: #f00; font-weight: bold;">
                                        <?php echo wc_price($sale_price); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="regular-price">
                                        <?php echo wc_price($regular_price); ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo 'No products found in this category.';
            }
            ?>
        </div>
      </div>

  </div>
  <div class="section-4">
    <p class="title">Loại giày thể thao</p>
  <?php
// Lấy đối tượng danh mục cha (parent category) có slug là 'sex'
$parent_category = get_term_by('slug', 'product', 'product_cat');

// Kiểm tra nếu danh mục cha tồn tại
if ($parent_category) {
    // Lấy tất cả danh mục con của danh mục cha có slug là 'sex'
    $child_categories = get_terms(array(
        'taxonomy'   => 'product_cat', // Taxonomy của WooCommerce
        'parent'     => $parent_category->term_id, // ID của danh mục cha
        'hide_empty' => false, // Hiển thị danh mục không có sản phẩm
    ));

    // Kiểm tra nếu có danh mục con
    if (!empty($child_categories) && !is_wp_error($child_categories)) {
        echo '<ul class="single-item">';
        foreach ($child_categories as $category) {
            // Lấy ảnh đại diện của danh mục con
            $image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $image_url = wp_get_attachment_url($image_id);

            // Lấy link đến trang danh mục con
            $category_link = get_term_link($category);

            // Hiển thị danh mục con với ảnh, link và số lượng sản phẩm
            echo '<li>';
            echo '<a href="' . esc_url($category_link) . '">';
            if ($image_url) {
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . ' />';
            }
            echo '<p class="category">' . esc_html($category->name);

            // Hiển thị số lượng sản phẩm trong category
            if ($category->count > 0) {
                echo ' (' . esc_html($category->count) . ' sản phẩm)';
            } else {
                echo ' (0 sản phẩm)';
            }

            echo '</p>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Không có danh mục con nào.';
    }
} else {
    echo 'Danh mục cha không tồn tại.';
}
?>
</div>

  </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/homepage.js?ver=<?= rand(100,999)?>"></script>
