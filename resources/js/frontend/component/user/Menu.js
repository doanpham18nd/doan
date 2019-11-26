import React, {Component} from 'react';
import {NavLink} from "react-router-dom";

class Menu extends Component {

    checkActiveBill = () => {
        if(window.location.pathname === '/user/waiting.html'
            || window.location.pathname === '/user/delivering.html'
            || window.location.pathname === '/user/delivered.html'
            || window.location.pathname === '/user/cancel.html') {
            return 'active-profile';
        }
    };


    render() {
        return (
            <div className="col-sm-3">
                <div className="left-sidebar">
                    <div className="panel-group category-products" id="accordian">
                        <div className="panel panel-default">
                            <div className="panel-heading">
                                <h4 className="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#"
                                       className="collapsed">
                                        Tài khoản của tôi
                                    </a>
                                </h4>
                            </div>
                            <div id="sportswear" className="panel-collapse">
                                <div className="panel-body ">
                                    <ul className="nav nav-pills nav-stacked">
                                        <li><NavLink activeClassName="active-profile" to={'/user/profile.html'}>Hồ sơ</NavLink></li>
                                        <li><NavLink activeClassName="active-profile" className={this.checkActiveBill( )}  to={'/user/purchase.html'}>Lịch sử giao dịch</NavLink></li>
                                        <li><NavLink activeClassName="active-profile" to={'/user/address.html'}>Địa chỉ nhận hàng</NavLink></li>
                                        <li><NavLink activeClassName="active-profile" to={'/user/password.html'}>Đổi mật khẩu</NavLink></li>
                                        <li><a href={'#'}>Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Menu;