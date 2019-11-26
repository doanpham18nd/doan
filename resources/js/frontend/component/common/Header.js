import React, {Component} from 'react';
import {NavLink} from "react-router-dom";
import axios from "axios";
import HeaderList from "./HeaderList";

const indexPath = '/index.html';

class Header extends Component {
    constructor(props) {
        super(props);
        this.state = {
            user: ''
        };
    };

    checkActiveParentMenu = (path) => {
        let pathActive = window.location.pathname;
        return (pathActive.indexOf(path) !== -1) ? "active menu-open" : "";
    };

    componentDidMount() {
        axios.get(window.Laravel.baseUrl + '/api/category')
            .then(response => {
                if (response.data.status === 1) {
                    this.setState(response.data.data)
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    makeCategoryList() {
        if (this.state.category1 instanceof Array) {
            return this.state.category1.map((object, i) => {
                return <HeaderList obj={object} key={i} index={i} checkActive={() => this.checkActive()}/>
            })
        }
    }

    makeCategoryList2() {
        if (this.state.category2 instanceof Array) {
            return this.state.category2.map((object, i) => {
                return <HeaderList obj={object} key={i} index={i} checkActive={() => this.checkActive()}/>
            })
        }
    }

    makeCategoryList3() {
        if (this.state.category3 instanceof Array) {
            return this.state.category3.map((object, i) => {
                return <HeaderList obj={object} key={i} index={i} checkActive={() => this.checkActive()}/>
            })
        }
    }
    checkToken = () => {
        if(localStorage.user) {
            let user = JSON.parse(localStorage.getItem('user'));
            return (
                <li><NavLink to={'/user/profile.html'}><i className="fa fa-user">{user.username}</i></NavLink></li>
            )
        } else {
            return <li><NavLink to={'/login.html'}><i className="fa fa-lock"/>Đăng nhập</NavLink></li>
        }
    };

    isChange = (event) => {
        const {target: {value}} = event;
        this.props.searchMedicine(value)
    };

    checkActive = (path) => {
        if (location.pathname === path) {
            return 'active'
        }
        return  '';
    };

    isKeyDown = (event) => {
        if (event.keyCode === 13) {
            const {target: {value}} = event;
            this.props.searchAfterEnter(value)
        }
    };

    render() {
        return (
            <header id="header">
                <div className="header_top">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-6">
                                <div className="contactinfo">
                                    <ul className="nav nav-pills">
                                        <li><a href="#"><i className="fa fa-phone"/> 0368 718 567</a></li>
                                        <li><a href="#"><i className="fa fa-envelope"/> doanpham94nd@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-sm-6">
                                <div className="social-icons pull-right">
                                    <ul className="nav navbar-nav">
                                        {this.checkToken()}
                                        <li><NavLink to="/gio-hang.html"><i className="fa fa-shopping-cart">Giỏ hàng</i></NavLink></li>
                                        <li><NavLink to="/gio-hang.html"><i className="fa fa-bell" aria-hidden="true"><span>Thông báo(1)</span></i></NavLink></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="header-middle">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-4">
                                <div className="logo pull-left">
                                    <img className='logo-header' src={'/frontend/images/logo.png'} alt="trang chủ"/>
                                </div>
                            </div>
                            <div className="col-sm-8">
                                <div className="search_box pull-right">
                                    <input type="text" name="keyword"
                                           onChange={(event) => this.isChange(event)}
                                           onKeyDown={(event) => this.isKeyDown(event)}
                                           placeholder="Tìm kiếm..." />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div className="header-bottom">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-12">
                                <div className="navbar-header">
                                    <button type="button" className="navbar-toggle" data-toggle="collapse"
                                            data-target=".navbar-collapse">
                                        <span className="sr-only">Toggle navigation</span>
                                        <span className="icon-bar"/>
                                        <span className="icon-bar"/>
                                        <span className="icon-bar"/>
                                    </button>
                                </div>
                                <div className="mainmenu pull-left">
                                    <ul className="nav navbar-nav collapse navbar-collapse">
                                        <li><a className={this.checkActive('/')} href={'/'}>TRANG CHỦ</a></li>
                                        <li className="dropdown"><NavLink to={'#'}>CHĂM SÓC DA MẶT</NavLink>
                                            <ul role="menu" className="sub-menu">
                                            {this.makeCategoryList()}
                                            </ul>
                                        </li>
                                        <li className="dropdown"><NavLink to={'#'}>CHĂM SÓC CƠ THỂ</NavLink>
                                            <ul role="menu" className="sub-menu">
                                                  {this.makeCategoryList2()}
                                            </ul>
                                        </li>
                                        <li className="dropdown"><NavLink to={'#'}>VIÊN UỐNG</NavLink>
                                            <ul role="menu" className="sub-menu">
                                                {this.makeCategoryList3()}
                                            </ul>
                                        </li>
                                        <li><a className={this.checkActive('/article/lam-dep.html')} href={'/article/lam-dep.html'}>LÀM ĐẸP</a></li>
                                        <li><a className={this.checkActive('/article/phong-kham.html')} href={'/clinic/lam-dep.html'}>PHÒNG KHÁM</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        );
    }
}

export default Header;
