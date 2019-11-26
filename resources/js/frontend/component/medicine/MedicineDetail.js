import React, {Component} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";

class MedicineDetail extends Component {
    constructor(props) {
        super(props);
        this.state = {
            medicineDetail: {},
            relatedActive: [],
            related: []
        };
    }

    componentDidMount() {
        let string = this.props.match.params.alias;
        let aryMedicine = string.split('-');
        let id = aryMedicine.splice(-1)[0];
        axios.get(window.Laravel.baseUrl + '/api/medicine/' + id)
            .then(response => {
                if (response.data.status === 1) {
                    document.title = response.data.data.medicineDetail.name;
                    this.setState(response.data.data)
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    addToCart = () => {
        const {history} = this.props;
        let data = {};
        if (localStorage.getItem('user')) {
            data.user_id = JSON.parse(localStorage.getItem('user')).id
        } else if (localStorage.getItem('userId')) {
            data.user_id = localStorage.getItem('userId');
        } else {
            let clientId = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            localStorage.setItem('userId', clientId);
            data.user_id = clientId
        }
        data.id = this.state.medicineDetail.id;
        data.price = this.state.medicineDetail.price;
        data.name = this.state.medicineDetail.name;
        data.quantity = 1;
        data.thumbnail_web = this.state.medicineDetail.thumbnail_web;
        data.format_price = this.state.medicineDetail.format_price;
        axios.post(window.Laravel.baseUrl + '/api/cart', data).then(res => {
            if (res.data.status === 1) {
                history.push('/gio-hang.html')
            }
        }).catch(function (error) {
            console.log(error.data);
        })
    };

    getRelatedMedicine = () => {
        return this.state.relatedActive.map((object, i) => {
            return (
                <div key={i} className="col-sm-4">
                    <div className="product-image-wrapper">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <Link to={'/' + object.alias + '-' + object.id + '.html'}>
                                    <img src={object.thumbnail_web} alt=""/>
                                    <p>{object.name}</p>
                                </Link>
                                <h4>{object.format_price} <sup>đ</sup></h4>
                            </div>
                        </div>
                    </div>
                </div>
            )
        })
    };

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="product-details">
                            <div className="col-sm-5">
                                <div className="view-product text-center">
                                    <img src={this.state.medicineDetail.thumbnail_web}
                                         alt={this.state.medicineDetail.name}/>
                                </div>

                            </div>
                            <div className="col-sm-7">
                                <div className="product-information">
                                    <h2>{this.state.medicineDetail.name}</h2>
                                    <p>{this.state.medicineDetail.short_content}</p>
                                    <p><b>Xuất xứ:</b> Nhật Bản</p>
                                    <p><b>Sản xuất tại:</b> Đài Loan</p>
                                    <p><b>Khối lượng tịnh:</b> 200g</p>
                                    <span>
									<span>Giá bán : {this.state.medicineDetail.format_price}<sup>đ</sup></span><br/>
                                        <span><button type="button" className="btn btn-fefault cart"
                                                      onClick={(event) => this.addToCart(event)}>MUA NGAY
									</button>
                                        </span>
								    </span>
                                </div>
                                <div className="product-information">
                                    <div className="info">
                                        Giao hàng miễn phí toàn Quốc
                                    </div>
                                    <div className="info">
                                        Được kiểm tra hàng trước khi thanh toán
                                    </div>
                                    <div className="info">
                                        Giao hàng nhanh chóng <br/>(Thanh toán Tiền mặt hoặc quẹt thẻ)
                                    </div>
                                    <div className="info">
                                        Được đổi hàng trong vòng 7 ngày với chính sách đặc biệt thuận lợi
                                    </div>
                                    <div className="info">
                                        Có tem chống hàng giả của bộ công an
                                    </div>
                                    <div className="info">
                                        Nhận ngay mẫu thử miễn phí khi mua hàng - Tích lũy nhận quà
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="category-tab shop-details-tab">
                            <div className="col-sm-12">
                                <ul className="nav nav-tabs">
                                    <li className="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a>
                                    </li>
                                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                                </ul>
                            </div>
                            <div className="tab-content">
                                <div className="tab-pane active in medicine-config" id="details"
                                     dangerouslySetInnerHTML={{__html: this.state.medicineDetail.content}}/>

                                <div className="tab-pane fade" id="reviews">
                                    <div className="col-sm-12">
                                        <ul>
                                            <li><a href=""><i className="fa fa-user"/>EUGEN</a></li>
                                            <li><a href=""><i className="fa fa-clock-o"/>12:41 PM</a></li>
                                            <li><a href=""><i className="fa fa-calendar-o"/>31 DEC 2014</a></li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor
                                            incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis
                                            nostrud
                                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis
                                            aute irure
                                            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur.</p>
                                        <p><b>Thêm bình luận</b></p>

                                        <form action="#">
										<span>
											<input type="text" placeholder="Tên của bạn"/>
											<input type="email" placeholder="Số điện thoại"/>
										</span>
                                            <textarea name=""/>
                                            <button type="button" className="btn btn-default pull-right">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="recommended_items">
                            <h2 className="title text-center">Sản phẩm cùng chức năng</h2>
                            <div id="recommended-item-carousel" className="carousel slide" data-ride="carousel">
                                <div className="carousel-inner">
                                    <div className="item active">
                                        {this.getRelatedMedicine()}
                                    </div>
                                    <div className="item">
                                        <div className="col-sm-4">
                                            <div className="product-image-wrapper">
                                                <div className="single-products">
                                                    <div className="productinfo text-center">
                                                        <img src="images/home/recommend1.jpg" alt=""/>
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" className="btn btn-default add-to-cart"><i
                                                            className="fa fa-shopping-cart"></i>Add to cart
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-sm-4">
                                            <div className="product-image-wrapper">
                                                <div className="single-products">
                                                    <div className="productinfo text-center">
                                                        <img src="images/home/recommend2.jpg" alt=""/>
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" className="btn btn-default add-to-cart"><i
                                                            className="fa fa-shopping-cart"></i>Add to cart
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-sm-4">
                                            <div className="product-image-wrapper">
                                                <div className="single-products">
                                                    <div className="productinfo text-center">
                                                        <img src="images/home/recommend3.jpg" alt=""/>
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" className="btn btn-default add-to-cart"><i
                                                            className="fa fa-shopping-cart"></i>Add to cart
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a className="left recommended-item-control" href="#recommended-item-carousel"
                                   data-slide="prev">
                                    <i className="fa fa-angle-left"></i>
                                </a>
                                <a className="right recommended-item-control" href="#recommended-item-carousel"
                                   data-slide="next">
                                    <i className="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default MedicineDetail;
