import React, {Component} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";

class PromotionDetail extends Component {
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
        axios.get(window.Laravel.baseUrl + '/api/promotion/' + id)
            .then(response => {
                if (response.data.status === 1) {
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
            console.log(error.data)
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
                    <div className="col-sm-12 text-center">
                        <img src={this.state.image_content}/>
                    </div>
                </div>
            </div>
        );
    }
}

export default PromotionDetail;
