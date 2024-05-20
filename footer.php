<?php

/**	
 * Template:			footer.php
 * Description:			The template for displaying the footer
 */

?>
<img class=" w-full h-[500px] object-cover" src="https://comwoo-karakimse.savviihq.com/wp-content/uploads/2024/05/scandi-room-10-frames-1-e1716122129803.png
">


<footer id="site-footer" class="footer">
    <div class="container">
        <div class="flex flex-col lg:grid lg:grid-cols-12 gap-5 pb-8">
            <div class="col-span-6">
                <h3>About us</h3>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam expedita, laudantium natus distinctio consequuntur quibusdam facere id nostrum exercitationem omnis aliquid, eos qui debitis voluptatibus nobis enim voluptatem porro quasi?</p>

            </div>
            <div class="lg:col-span-3">
                <h3>Shop</h3>
                <div class="editor">

                    <ul>
                        <li>
                            <a class=" social" href="https://www.instagram.com/studiojambo.nl">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lg:col-span-3">
                <h3>Socials</h3>
                <div class="editor">
                    <ul>
                        <li>
                            <a class=" social" href="https://www.instagram.com/studiojambo.nl">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="footer__bar">
        <div class="container">
            <div class="flex justify-between">
                <p>Handmade with love © <?php echo date("Y"); ?> All rights reverved</p>
                <div class="hidden lg:block">minipay</div>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>