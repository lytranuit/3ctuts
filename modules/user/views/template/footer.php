<footer>
    <div class="middle">
        <div class="container">
            <div class="row footer-menu">
                <div class="col-md-4">
                    <h2 class="footer-title">Giới thiệu</h2>
                    <p></p>
                </div>

                <div class="col-md-4">
                    <h2 class="footer-title">Liên hệ</h2>
                    <p></p>
                </div>

                <div class="col-md-4 ">
                    <h2>Thống kê</h2>
                    <p><span style="color: #00C500;">Online:</span> <i><?= $online[0]['guest']; ?> khách,<?= $online[0]['member']; ?> thành viên </i></p>
                    <p><span style="color: #FF0505;">Video:</span> <i><?= $allvideos[0]['numvideos']; ?> video </i></p>
                    <p><span style="color: yellow;">Truy cập:</span> <i> <?= $allviews[0]['numviews']; ?> lượt truy cập </i></p>
                    <a href="https://www.facebook.com/bootsnipp"><i id="social" class="fa fa-facebook-square fa-2x social-fb"></i></a>
                    <a href="https://twitter.com/bootsnipp"><i id="social" class="fa fa-twitter-square fa-2x social-tw"></i></a>
                    <a href="https://plus.google.com/+Bootsnipp-page"><i id="social" class="fa fa-google-plus-square fa-2x social-gp"></i></a>
                    <a href="mailto:bootsnipp@gmail.com"><i id="social" class="fa fa-envelope-square fa-2x social-em"></i></a>

                </div>

            </div>
        </div>
    </div>

    <div class="bottom">
        Copyright &copy; 2015. Created by <a href="">Lý Trân</a>
    </div>
</footer>