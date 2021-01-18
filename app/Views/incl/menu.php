<nav class="nav-menu d-none d-lg-block">
    <ul>
      <?php  foreach($menu as $menuer) { ?>
           <li>
              <a href="<?php echo $menuer['links']; ?>"><strong><?php echo $menuer['captions']; ?></strong></a>
            </li>
       <?php  } ?>
    </ul>
</nav><!-- .nav-menu -->
