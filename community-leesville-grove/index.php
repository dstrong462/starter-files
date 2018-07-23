<?php include('header.php'); ?>

<section class="hero">
    <div class="wrapper">
        <div class="content">
            <div class="title">Leesville Grove</div>
            <div class="subtitle">Single Family Homes from the <sup>$</sup>445s</div>
        </div>
        <form class="hero-form" method="post">
            <?php if ($_GET['thank_you']) : ?>
                <div class="form-header">Thank You!</div>
            <?php else : ?>
                <div class="form-header">Find Your Dream Home!</div>
            <?php endif; ?>
            <div class="form-content">
                <?php if (!empty($form['errors'])) { ?>
                    <div class="form-row">
                        <ul class="errors">
                            <?php foreach ($form['errors'] as $error) { ?>
                            <li class="error"><?=$error?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($_GET['thank_you']) : ?>
                    <div class="form-row thank-you">
                        Your form submission has been received, and Kristy will be in touch with you shortly!
                    </div>
                <?php else : ?>
                    <div class="form-row">
                        <label for="user_name">Full Name *</label>
                        <input class="input-txt" type="text" id="user_name" name="user_name" value="<?=$form['input']['user_name']?>">
                    </div>
                    <div class="form-row split">
                        <div class="form-row">
                            <label for="user_phone">Phone *</label>
                            <input class="input-txt" type="tel" id="user_phone" name="user_phone" value="<?=$form['input']['user_phone']?>">
                        </div>
                        <div class="form-row">
                            <label for="user_email">Email *</label>
                            <input class="input-txt" type="email" id="user_email" name="user_email" value="<?=$form['input']['user_email']?>">
                        </div>
                    </div>
                    <div class="form-row textarea">
                        <label for="user_comments">Tell us more about the home you are looking for.</label>
                        <textarea class="input-txt" id="user_comments" name="user_comments"><?=$form['input']['user_comments']?></textarea>
                    </div>
                    <div class="form-row">
                        <input type="hidden" id="breathing" name="breathing">
                        <button class="btn btn-gold" type="submit" id="submit" name="submit">Contact Us Today</button>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</section>

<div class="promo-bar">
    <div class="wrapper">
       Visit Leesville Grove & Register For A Chance To <strong style="color:#ffe3ad;">Win A $2,500 Lowe's Gift Card!</strong>*
    </div>
</div>

<section class="intro-content">
    <div class="wrapper">
        <div class="title">Say Hello To</div>
        <div class="subtitle">Your New Home</div>
        <div class="title-info">From the $445s | Raleigh, NC</div>
        <p>Just minutes from I-540, Terramor Homes’ Leesville Grove community is close to great schools, a variety of restaurants, great shopping, and more. With homes from the $445s, Leesville Grove offers a limited 21 homesites with the most desired features including hardwood flooring, 2-car garages, screened porches, and so much more. Fill out the form above to secure your spot in this  highly sought-after community in Raleigh!</p>
    </div>
</section>

<section class="features">
    <div class="image"></div>
    <div class="icons">
        <div class="icon-col animate from-bottom lazyload" data-expand="-200">
            <div class="icon"><?=get_svg('icon-design')?></div>
            <div class="text">Thoughtfully Designed</div>
        </div>
        <div class="icon-col animate from-top lazyload" data-expand="-200">
            <div class="icon"><?=get_svg('icon-award')?></div>
            <div class="text">Award-Winning Home Designs</div>
        </div>
        <div class="icon-col animate from-bottom lazyload" data-expand="-200">
            <div class="icon"><?=get_svg('icon-affordable')?></div>
            <div class="text">Affordable Luxury</div>
        </div>
    </div>
</section>

<section class="location">
    <div class="content">
        <div class="title">Conveniently Located</div>
        <p>Raleigh is THE ideal location for growing families with access to local attractions including PNC Arena, Falls Lake, Umstead State Park, NC Museum of Art, Capital Area Greenway, university sports games, downtown food and drink festivals, and so much more!</p>
        <a href="//www.google.com/maps/place/Terramor+Homes+-+Leesville+Grove/@35.9189347,-78.7493222,15z/data=!4m5!3m4!1s0x0:0xddff8732c7fbbbdc!8m2!3d35.9189347!4d-78.7493222" target="_blank" class="btn">Get Directions</a>
    </div>
    <div class="map"></div>
</section>

<section class="footer-form-block">
    <div class="wrapper">
        <div class="content-row">
            <div class="image">
                <img src="library/img/img-kristy-pollard.png" alt="Kristy Pollard">
            </div>
            <div class="content">
                <div class="title">Want to Know More?</div>
                <p>If you’re ready to explore Leesville Grove, contact Kristy Pollard, your personal home-buying consultant. Kristy is dedicated to learning more about your family’s needs and desires to help you find your perfect home in one of our great communities!</p>
            </div>
        </div>
        <?php if (!$_GET['thank_you']) : ?>
            <form class="footer-form" method="post">
                <div class="form-row">
                    <label for="user_name">Full Name *</label>
                    <input class="input-txt" type="text" id="user_name" name="user_name" value="<?=$form['input']['user_name']?>">
                </div>
                <div class="form-row">
                    <label for="user_phone">Phone *</label>
                    <input class="input-txt" type="tel" id="user_phone" name="user_phone" value="<?=$form['input']['user_phone']?>">
                </div>
                <div class="form-row">
                    <label for="user_email">Email *</label>
                    <input class="input-txt" type="email" id="user_email" name="user_email" value="<?=$form['input']['user_email']?>">
                </div>
                <div class="form-row textarea">
                    <label for="user_comments">Comments</label>
                    <textarea class="input-txt" id="user_comments" name="user_comments"><?=$form['input']['user_comments']?></textarea>
                </div>
                <div class="form-row submit">
                    <input type="hidden" id="breathing" name="breathing">
                    <button class="btn btn-gold" type="submit" id="submit" name="submit">Contact Us</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>


<?php include('footer.php'); ?>