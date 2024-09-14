      </div>
      <footer id="footer">
        <div class="grid-container">
          <div class="grid-x">
            <div class="cell text-center">
              <p>&copy; <?= date('Y');?> <?= get_bloginfo('name')?> - <?= esc_html__('All rights reserved', 'theme_language')?></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
