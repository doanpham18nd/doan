import React, {Component} from 'react';
import Menu from "../Menu";
import {NavLink} from "react-router-dom";
import axios from "axios";
import Row from "./Row";

class WaitingPay extends Component {

    constructor(props) {
        super(props);
        this.state = {
            waitingPay: []
        }
    }

    componentDidMount() {
        let params = new URLSearchParams();
        let user =  JSON.parse(localStorage.getItem('user'));
        let userId = user.id;
        params.append("userId", userId);
        params.append("status", '0');
        let request = {
            params: params
        };
        axios.get('/api/bill/', request).then(res => {
            this.setState({
                waitingPay: res.data.data
            })
        }).catch(error => {

        })
    }

    fetchBillList = () => {
        return this.state.waitingPay.map((object, i) => {
            return (
                <Row key={i} obj={object}/>
            )
        })
    };

    render() {
        return (
            <div className="container">
                <div className="row">
                    <Menu/>
                    <div className="col-sm-9">
                        <div className="">
                            <div className="features_items">
                                <ul className="nav nav-tabs">
                                    <li className="tab-purchase tab-purchase-active"><NavLink to={'/user/waiting.html'}>Chờ thanh toán</NavLink></li>
                                    <li className="tab-purchase"><NavLink to={'/user/delivering.html'}>Đang giao</NavLink></li>
                                    <li className="tab-purchase"><NavLink to={'/user/delivered.html'}>Đã giao</NavLink></li>
                                    <li className="tab-purchase"><NavLink to={'/user/cancel.html'}>Đã hủy</NavLink></li>
                                </ul>
                                {this.fetchBillList()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default WaitingPay;