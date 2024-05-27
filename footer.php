<?php

/**	
 * Template:			footer.php
 * Description:			The template for displaying the footer
 */

?>
<img class=" w-full aspect-2x1 lg:aspect-3x1 object-cover" src="https://comwoo-karakimse.savviihq.com/wp-content/uploads/2024/05/scandi-room-10-frames-1-e1716122129803.png
">


<footer id="site-footer" class="footer">
    <div class="container">
        <div class="flex flex-col lg:grid lg:grid-cols-12 gap-5 pb-8">
            <div class="col-span-7">
                <h3>About</h3>

                <p class="lg:w-4/5">Studio Jambo shows handmade products crafted by Anneloes Louwe. It also demonstrates the <span class="font-heading uppercase">MiniPay for WooCommerce</span> plugin, which was also developed by Anneloes Louwe. The plugin and this website were developed during the Build With Celo 6 hackathon (May 17th 2024 - June 2nd 2024).</p>

            </div>
            <div class="lg:col-span-2">
                <h3>Shop</h3>
                <div class="editor editor--footer">

                    <ul>
                        <li>
                            <a href="/product/swan-in-wooden-frame/">Swan</a>
                        </li>
                        <li>
                            <a href="/product/paw-in-wooden-frame/">Paw</a>
                        </li>
                        <li>
                            <a href="/product/teckel-in-wooden-frame/">Teckel</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lg:col-span-3">
                <h3>Socials</h3>
                <div class="editor editor--footer">
                    <ul>
                        <li>
                            <a href="https://www.instagram.com/studiojambo.nl">Instagram</a>
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