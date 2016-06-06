<div class="news-card">
    <div class="news-card__embedded">
        <?php echo $embedded[0]; ?>
    </div>
    <a href="<?php echo $link ?>">
        <div class="news-card__caption">
            <h4 class="news-card__title"><?php echo $title ?></h4>
            <p class="news-card__content"><?php echo $content; ?></p>
            <small class="news-card__source"><?php echo $source ?></small>
        </div>
        <p class="news-card__content-animated"><?php echo $content; ?></p>
    </a>
</div>
