import React, {Component} from 'react';
import axios from "axios";
import Row from "./Row";
import {Link} from "react-router-dom";
import Address from "./Address";
import DatePicker from "react-datepicker/es";

class Cart extends Component {

    constructor(props) {
        document.title = 'Giỏ hàng';
        super(props);
        this.state = {
            cart: [],
            userId: '',
            default: true,
            user: {},
            showAddress: false,
            date: new Date(),
            province: [],
            district: [],
            ward: [],
            forMe: true,
            deliver_province: '',
            deliver_district: '',
            deliver_ward: 'this.state.deliver_ward',
            deliver_order: '',
            deliver_message: ''
        }
    }

    componentDidMount() {
        let userId = '';
        axios.get('/api/province').then(response => {
            this.setState({
                province: response.data.data,
            })
        }).catch(error => {
            console.log(error)
        });
        if (localStorage.getItem('user')) {
            userId = JSON.parse(localStorage.getItem('user')).id;
            this.setState({
                user: JSON.parse(localStorage.getItem('user'))
            })
        } else {
            userId = localStorage.getItem('userId')
        }
        this.setState({
            userId: userId
        });
        axios.get(window.Laravel.baseUrl + '/api/cart/' + userId).then(res => {
            if (res.data.data.cart.length !== 0) {
                this.setState({
                    emptyCart: false
                })
            } else {
                this.setState({
                    emptyCart: true
                })
            }
            this.setState(res.data.data)
        }).catch(error => {
            console.log(error)
        })
    }

    fetchList = () => {
        let list = Object.values(this.state.cart);
        return list.map((object, i) => {
            return <Row addCart={(id) => this.addCart(id)}
                        subCart={(id) => this.subCart(id)}
                        deleteCart={(id) => this.deleteCart(id)}
                        obj={object} key={i} index={i}/>
        })
    };

    addCart = (id) => {
        let data = {};
        data.id = id;
        data.user_id = this.state.userId;
        axios.post(window.Laravel.baseUrl + '/api/cart/add', data).then(response => {
            if (response.data.data.cart.length !== 0) {
                this.setState({
                    emptyCart: false
                })
            } else {
                this.setState({
                    emptyCart: true
                })
            }
            this.setState(response.data.data)
        }).catch(error => {
            console.log(error)
        })
    };

    subCart = (id) => {
        let data = {};
        data.id = id;
        data.user_id = this.state.userId;
        axios.post(window.Laravel.baseUrl + '/api/cart/div', data).then(response => {
            if (response.data.data.cart.length !== 0) {
                this.setState({
                    emptyCart: false
                })
            } else {
                this.setState({
                    emptyCart: true
                })
            }
            this.setState(response.data.data)
        }).catch(error => {
            console.log(error)
        })
    };

    deleteCart = (id) => {
        let data = {};
        data.id = id;
        data.user_id = this.state.userId;
        axios.post(window.Laravel.baseUrl + '/api/cart/del', data).then(response => {
            this.setState(response.data.data);
            if (response.data.data.cart.length !== 0) {
                this.setState({
                    emptyCart: false
                })
            } else {
                this.setState({
                    emptyCart: true
                })
            }
        }).catch(error => {
            console.log(error)
        })
    };

    checkout = () => {
        if (localStorage.getItem('user')) {
            const {history} = this.props;
            let data = {};
            data.user_id = this.state.userId;
            data.real_total = this.state.real_total;
            if (!this.state.forMe) {
                data.deliver = this.state.deliver;
                data.forMe = this.state.forMe;
                data.deliver_province = this.state.deliver_province;
                data.deliver_district = this.state.deliver_district;
                data.deliver_ward = this.state.deliver_ward;
                data.deliver_order = this.state.date;
                data.deliver_message = this.state.deliver_message;
            }
            axios.post('/api/cart/checkout', data).then(response => {
                if (response.data.status === 1) {
                    this.setState({
                        cart: {}
                    });
                    history.push('/user/purchase.html')
                }
            }).catch(error => {
                console.log(error)
            })
        } else {
            alert('vui lòng đăng nhập để có thể thanh toán')
        }

    };

    updateDefault = (e) => {
        e.preventDefault();
        let data = {};
        data.address = this.state.address;
        data.user_id = this.state.userId;
        data.token = this.state.user.token;
        axios.post('/api/user/address', data).then(res => {
            this.changeAddressFlg();
            this.setState({
                user: res.data.data
            });
            localStorage.setItem('user', JSON.stringify(res.data.data))
        }).catch(error => {
            console.log(error)
        })
    };

    handleFieldChange = (event) => {
        this.setState({
            [event.target.name]: event.target.value
        });
    };

    getAddress = () => {
        return this.state.user.address.map((object, i) => {
            return <Address obj={object} key={i} index={i}
                            username={this.state.user.username}
                            handleFieldChange={(event) => this.handleFieldChange(event)}
                            phone={this.state.user.phone}/>
        })
    };
    showAddressList = () => {
        if (this.state.showAddress && localStorage.getItem('user')) {
            return (
                <div className="register-req">
                    <form onSubmit={(event) => this.updateDefault(event)}>
                        {this.getAddress()}
                        <div>
                            <input type="submit" className="btn btn-primary" value="Hoàn thành"/>
                            <button className="btn btn-primary btn-custom" onClick={() => this.changeAddressFlg()}>Trở
                                lại
                            </button>
                        </div>
                    </form>
                </div>
            )
        }
    };

    handleChange = (date) => {
        this.setState({
            date: date
        });
    };

    changeAddressFlg = () => {
        this.setState({
            showAddress: !this.state.showAddress
        })
    };

    showAddressDefaultRow = () => {
        if (!this.state.showAddress && localStorage.getItem('user')) {
            return this.state.user.address.map((object, i) => {
                if (object.default) {
                    return (
                        <div key={i} className="register-req">
                            <span className="">{this.state.user.username + ' ' + this.state.user.phone} </span> -
                            {object.address + ', ' + object.ward_name + ', ' + object.district_name + ', ' + object.province_name}
                            <span className="margin-address change-address"
                                  onClick={() => this.changeAddressFlg()}>THAY ĐỔI</span>
                        </div>
                    )
                } else {
                    return null;
                }
            })
        }
    };

    checkUserLogin = () => {
        if (!localStorage.getItem('user')) {
            return (
                <div className="register-req">
                    <p>Vui lòng đăng nhập hoặc đăng ký để có thể thanh toán cũng như truy cập vào lịch sử đặt hàng của
                        bạn cho lần sau! Xin cám ơn</p>
                </div>
            )
        }
    };

    checkForMe = () => {
        return (
            <div className="padding-bottom">
                <div className="col-xs-6 padding-bottom">
                    <h3 className="ptitle">
                        <span><span className="co-title">1)</span> Thông tin người nhận quà</span>
                    </h3>
                    <fieldset className="login-form">
                        <div className="form-group">
                            <input type="text" className="form-control" id="name"
                                   placeholder="Họ và tên người nhận"
                                   onChange={(event) => this.handleFieldChange(event)}
                                   name="deliver"/>
                        </div>
                        <div className="form-group">
                            <select className="form-control" onChange={(event) => this.getDistrict(event)} name="deliver_province">
                                <option>----Chọn thành phố----</option>
                                {this.getProvince()}
                            </select>
                        </div>
                        <div className="form-group">
                            <select className="form-control"
                                    name="deliver_district"
                                    onChange={(event) => this.getWard(event)}>
                                <option>----Chọn quận huyện----</option>
                                {this.setDistrict()}
                            </select>
                        </div>
                        <div className="form-group">
                            <select className="form-control" name="deliver_ward" onChange={(event) => this.handleFieldChange(event)}>
                                <option>----Chọn xã----</option>
                                {this.setWard()}
                            </select>
                        </div>
                        <div className="form-group">
                            <input type="text" className="form-control col-xs-6" id="deliver_address"
                                   onChange={(event) => this.handleFieldChange(event)}
                                   placeholder="Địa chỉ chi tiết"
                                   name="deliver_address"/>
                        </div>
                    </fieldset>
                </div>
                <div className="col-xs-6">
                    <h3 className="ptitle">
                        <span><span className="co-title">2)</span> Ngày giao và nội dung thiệp</span>
                    </h3>
                    <fieldset>
                        <div className="form-group">
                            <DatePicker
                                dateFormat="dd-MM-yyyy"
                                selected={this.state.date}
                                onChange={this.handleChange}
                                className="form-control"
                                name="deliver_order"
                            />
                        </div>
                        <div className="form-group">
                                    <textarea rows={7} className="form-control" name="deliver_message" onChange={(event) => this.handleFieldChange(event)}
                                              placeholder="Nội dung thiệp, yêu cầu giấu tên ..."/>
                        </div>
                    </fieldset>
                </div>
            </div>
        )
    };

    checkShowForMe = () => {
        if (this.state.forMe) {
            return (
                <div>
                    {this.showAddressDefaultRow()}
                    {this.showAddressList()}
                </div>
            )
        }
        return (
            this.checkForMe()
        )
    }

    checkEmptyCart = () => {
        if (this.state.cart.length !== 0) {
            return <div className="container">
                {this.checkUserLogin()}
                {this.checkShowForMe()}
                <div className="table-responsive cart_info">
                    <table className="table table-condensed">
                        <thead>
                        <tr className="cart_menu">
                            <td className="image">Giỏ hàng của bạn</td>
                            <td className="description"/>
                            <td className="price"/>
                            <td className="quantity"/>
                            <td className="total"/>
                            <td/>
                        </tr>
                        </thead>
                        <tbody>
                        {this.fetchList()}
                        <tr>
                            <td className="cart_product"/>
                            <td className="cart_description"/>
                            <td className="cart_price"><label className="total_sub">Tổng tiền:</label></td>
                            <td className="cart_quantity">
                                <span className="total-price">{this.state.total} <sup>đ</sup>
                                </span>
                            </td>
                            <td className="cart_delete"/>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button className="btn btn-primary submit-cart" onClick={() => this.checkout()}>THANH TOÁN</button>
            </div>
        } else {
            return (
                <div className="container">
                    <div className="text-center">
                        <img width={200} alt={'giỏ hàng của bạn còn trống'}
                             src={window.Laravel.baseUrl + '/frontend/images/f3540f6657bbdc1120e3f8cc90bdba97.png'}/>
                        <p className="empty-cart">Giỏ hàng của bạn còn trống</p>
                        <Link to={'/'} className="btn btn-primary">Trở lại mua sắm</Link>
                    </div>
                </div>
            )
        }
    };

    getProvince = () => {
        return this.state.province.map((object, i) => {
            return <option key={i} value={object.province_id}>{object.name}</option>
        })
    };

    getDistrict = (event) => {
        axios.get('api/district/' + event.target.value).then(response => {
            this.setState({
                district: response.data.data
            })
        }).catch(error => {
            console.log(error)
        })
        this.setState({
            deliver_province: event.target.value
        })
    };

    setDistrict = () => {
        return this.state.district.map((object, i) => {
            return <option key={i} value={object.district_id}>{object.name}</option>
        })
    };

    getWard = (event) => {
        axios.get('api/ward/' + event.target.value).then(response => {
            this.setState({
                ward: response.data.data
            })
        }).catch(error => {
            console.log(error)
        })
        this.setState({
            deliver_district: event.target.value
        })
    };

    setWard = () => {
        return this.state.ward.map((object, i) => {
            return <option key={i} value={object.ward_id}>{object.name}</option>
        })
    };

    setChange = () => {
        this.setState({
            forMe: !this.state.forMe
        })
    };

    render() {
        console.log(this.state);
        return (
            <div>
                <section id="cart_items">
                    <div className="container">
                        <div className='form-group'>
                            <input type="radio" name="billing[use_for_shipping]" onChange={() => this.setChange()}
                                   id="billing:use_for_shipping_yes" value="1" defaultChecked={true}
                                   title="Giao hàng ở địa chỉ này" className="radio"/>Chuyển quà đến cho tôi
                            <input type="radio" name="billing[use_for_shipping]"
                                   id="billing:use_for_shipping_no" value="0" onChange={() => this.setChange()}
                                   title="Nhận hàng ở địa chỉ khác" className="radio"/>Chuyển quà đến người khác
                        </div>
                    </div>
                    {this.checkEmptyCart()}
                </section>

            </div>
        );
    }
}

export default Cart;
