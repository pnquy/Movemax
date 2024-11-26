<?php
  /*Template name: homepage */
 ?>
 <?php get_header() ?>
 <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/homepage.css?ver=<?= rand(100, 999)?>"/>
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
</div>
