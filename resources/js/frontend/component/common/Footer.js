import React, {Component} from 'react';

class Footer extends Component {
    render() {
        return (
            <footer id="footer">

                <div className="footer-widget">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-3">
                                <div className="single-widget">
                                    <h2>DỊCH VỤ</h2>
                                    <ul className="nav nav-pills nav-stacked">
                                        <li><a href="#">Trợ giúp online</a></li>
                                        <li><a href="#">Liên hệ chúng tôi</a></li>
                                        <li><a href="#">Trạng thái đơn hàng</a></li>
                                        <li><a href="#">Thay đổi vị trí</a></li>
                                        <li><a href="#">FAQ’s</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-sm-3">
                                <div className="single-widget">
                                    <h2>DANH MỤC SẢN PHẨM</h2>
                                    <ul className="nav nav-pills nav-stacked">
                                        <li><a href="#">Kem chống nắng</a></li>
                                        <li><a href="#">Kem trị nám</a></li>
                                        <li><a href="#">Kem dưỡng ẩm</a></li>
                                        <li><a href="#">Kem chống lão hóa</a></li>
                                        <li><a href="#">Xịt khoáng</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-sm-3">
                                <div className="single-widget">
                                    <h2>BẢO MẬT</h2>
                                    <ul className="nav nav-pills nav-stacked">
                                        <li><a href="#">Điều khoản</a></li>
                                        <li><a href="#">Thông tin</a></li>
                                        <li><a href="#">Refund Policy</a></li>
                                        <li><a href="#">Billing System</a></li>
                                        <li><a href="#">Ticket System</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-sm-3">
                                <div className="single-widget">
                                    <h2>THÔNG TIN WEBSITE</h2>
                                    <ul className="nav nav-pills nav-stacked">
                                        <li><a href="#">Thông tin</a></li>
                                        <li><a href="#">Môi trường</a></li>
                                        <li><a href="#">Ví trị</a></li>
                                        <li><a href="#">Điều lệ</a></li>
                                        <li><a href="#">Bản quyền</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div className="footer-bottom">
                    <div className="container">
                        <div className="row">
                            <p className="pull-left">Copyright © 2019 Hoa Anh Dao Inc. All rights reserved.</p>
                            <p className="pull-right">Designed by <span><a target="_blank"
                                                                           href="http://www.themeum.com">PVD</a></span>
                            </p>
                        </div>
                    </div>
                </div>

            </footer>
        );
    }
}

export default Footer;
