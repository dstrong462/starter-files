<footer class="footer">
    <div class="wrapper">
        <div class="logos">
            <a class="logo" href="//www.terramorhomes.com"><img src="library/img/logo-terramor.png" alt="Terramor Homes"></a>
            <a class="logo" href="//newhomes.terramorhomes.com"><img src="library/img/logo-leesville.png" alt="Leesville Grove"></a>
        </div>
        <div class="contact-info">
            <a class="phone" href="tel:<?=$_SESSION['phone']?>"><?=$_SESSION['phone']?></a>
            <div class="address">10004 Leesville Grove Drive</div>
            <div class="address">Raleigh, NC 27613</div>
        </div>
    </div>
    <div class="disclaimer">*Receive up to $4,000 in Closing Costs on any contract written between 7/1/18 thru 7/31/18, only valid when using a Terramor Homes preferred lender and closing attorney. Certain restrictions may apply with specific lenders and loan programs, minimum loan amount may apply, may not be applicable with all loan types. ***Free Appliance Package only available on completed inventory homes at Leesville Grove. Receive up to $3,000 in allowable options. Only valid on contracts written between 7/1/18 thru 7/31/18 and closing within 60 Days of written contract and when using a Terramor Homes preferred lender and closing attorney. ±No purchase necessary. One entry per household, per Community. Winner will be randomly chosen by 8/6/18 and contacted via phone and/or email. (ARV: $2,500, Lowe’s Home Improvement Gift Card). Please see a Builder Representative for more details on incentives. Terramor Homes reserves the right to withdraw from any incentive or promotion at any time. Prices subject to change. Copyright © 2018 Terramor Homes, Inc. Equal Housing Opportunity. </div>
</footer>
<footer class="post-footer">
    <div class="wrapper">
        <div class="legal">
            <div class="copy">&copy; <?=date('Y')?> TERRAMOR HOMES. All Rights Reserved.</div>
            <a class="link" href="//newhomes.terramorhomes.com/privacy/" target="_blank">Privacy Policy</a>
            <a class="link" href="//www.hud.gov/fairhousing" target="_blank"><?=get_svg('logo-eho')?></a>
        </div>
        <div class="trimark">
            Lead Generation Management By
            <a href="//www.trimarkdigital.com" target="_blank"><?=get_svg('logo-trimark')?></a>
        </div>
    </div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="library/js/min/scripts-min.js"></script>

<?php if($_GET['thank_you']) : ?>
    
    <!-- Google Code for Form Leads Conversion Page -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 978920884;
    var google_conversion_language = "en";
    var google_conversion_format = "2";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "-VcqCNyU-ggQtMvk0gM";
    var google_remarketing_only = false;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/978920884/?label=-VcqCNyU-ggQtMvk0gM&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>
        
<?php else : ?>
    
    <!-- Google Code for Remarketing Tag -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 978920884;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/978920884/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>
    
    <!-- Google Code for Click To Call (LP Only) Conversion Page
    In your html page, add the snippet and call
    goog_report_conversion when someone clicks on the
    phone number link or button. -->
    <script type="text/javascript">
        /* <![CDATA[ */
        goog_snippet_vars = function() {
        var w = window;
        w.google_conversion_id = 978920884;
        w.google_conversion_label = "iVTDCK_grWQQtMvk0gM";
        w.google_remarketing_only = false;
        }
        // DO NOT CHANGE THE CODE BELOW.
        goog_report_conversion = function(url) {
        goog_snippet_vars();
        window.google_conversion_format = "3";
        var opt = new Object();
        opt.onload_callback = function() {
        if (typeof(url) != 'undefined') {
            window.location = url;
        }
        }
        var conv_handler = window['google_trackConversion'];
        if (typeof(conv_handler) == 'function') {
        conv_handler(opt);
        }
    }
    /* ]]> */
    </script>
    <script type="text/javascript"
        src="//www.googleadservices.com/pagead/conversion_async.js">
    </script>
    
<?php endif; ?>

</body>
</html>