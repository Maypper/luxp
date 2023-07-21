<?php
$subtitle = get_field('subtitle');
$title = get_field('title');
$text = get_field('text');
$btn = get_field('btn');
$video = get_field('video');
$video_poster = get_field('video_poster');
?>
<section class="text-video">
    <div class="container text-video__wrapper">
        <div class="text-video__text">
            <p class="subtitle"><?php echo $subtitle; ?></p>
            <h3><?php echo $title; ?></h3>
            <p><?php echo $text ?></p>
            <?php if ($btn): ?>
                <a href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>" class="btn secondary-btn"><?php echo $btn['title']; ?></a>
            <?php endif; ?>
        </div>
        <div class="text-video__video">
            <div class="video_wrapper">
                <video class="custom-controls paused" name="media" preload="none" poster="<?php echo $video_poster; ?>" style="max-width: 100%;">
                    <source src="<?php echo $video; ?>" type="video/mp4">
                </video>
                <svg class="play-btn paused" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.16 8.37199C18.8609 8.15906 18.5091 8.03256 18.1429 8.00633C17.7767 7.98011 17.4104 8.05517 17.084 8.2233C16.7577 8.39143 16.4839 8.64614 16.2927 8.95953C16.1015 9.27291 16.0002 9.63288 16 9.99999V50C16.0002 50.3671 16.1015 50.7271 16.2927 51.0405C16.4839 51.3538 16.7577 51.6085 17.084 51.7767C17.4104 51.9448 17.7767 52.0199 18.1429 51.9936C18.5091 51.9674 18.8609 51.8409 19.16 51.628L47.16 31.628C47.4193 31.443 47.6306 31.1987 47.7764 30.9156C47.9222 30.6324 47.9983 30.3185 47.9983 30C47.9983 29.6815 47.9222 29.3676 47.7764 29.0844C47.6306 28.8012 47.4193 28.557 47.16 28.372L19.16 8.37199Z" fill="#3F3F3F"/>
                </svg>
            </div>
        </div>
    </div>
</section>

