<footer>
    <div class="footer wrapper-footer-newsletter">
        <div class="main-top-footer">
            <div class="container">
                <div class="row">
                    <aside class="col-sm-3 col-6  ">
                        <div class="textwidget">
                            <ul class="menu list-arrow">
                                <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                <li><a href="{{ route('contact.create') }}">Contact Us</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="{{ route('mission') }}">Mission & Vision</a></li>
                            </ul>
                        </div>
                    </aside>
                    <aside class="col-sm-3 col-6 ">
                        <div class="textwidget">
                            <ul class="menu list-arrow">
                                <li><a href="{{ route('payments') }}">Payments</a></li>
                                <li><a href="{{ route('shipping') }}">Shippings</a></li>
                                <li><a href="{{ route('cancellation') }}">Cancellation & Returns</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </aside>
                    <aside class="col-sm-3 col-6 ">
                        <div class="textwidget">
                            <ul class="menu list-arrow">
                                <li><a href="{{ route('return_policy') }}">Return Policy</a></li>
                                <li><a href="{{ route('terms_conditions') }}">Terms of Use</a></li>
                                <li><a href="{{ route('privacy_policy') }}">Privacy</a></li>
                                <li><a href="#">Sitemap</a></li>
                            </ul>
                        </div>
                    </aside>
                    <aside class="col-sm-3 col-6 custom-instagram ">
                        <div class="textwidget">
                            <ul class="menu list-arrow">
                                <li><a href="{{ getConfiguration('facebook_link') }}" target="_blank"><span class="fab fa-facebook"></span> Facebook</a></li>
                                <li><a href="{{ getConfiguration('instagram_link') }}" target="_blank"><span class="fab fa-instagram"></span> Instagram</a></li>
                                <li><a href="{{ getConfiguration('youtube_link') }}" target="_blank"><span class="fab fa-youtube"></span> Youtube</a></li>
                                <li><a href="{{ getConfiguration('twitter_link') }}" target="_blank"><span class="fab fa-twitter"></span> Twitter</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

    </div>

</footer>
