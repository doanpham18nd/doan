import React, {Component} from 'react';
import Menu from "../Menu";
import {Link} from "react-router-dom";
import axios from "axios";
import Row from "./Row";
import RowDetail from "./RowDetail";

class BillDetail extends Component {

    constructor(props) {
        super(props);
        this.state = {
            waitingPay: {},
            billDetail: []
        }
    }

    componentDidMount() {
        axios.get('/api/bill/' + this.props.match.params.id).then(res => {
            this.setState({
                waitingPay: res.data.data,
                billDetail: res.data.data.bill_detail
            })
        }).catch(error => {

        })
    }

    fetchMedicineList = () => {
        return this.state.billDetail.map((object, i) => {
            return <RowDetail obj={object} key={i}/>
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
                                <div className="register-req"><span className="">Lương Minh Phương(0368718567) </span><br/>
                                Tòa nhà Sông Đà, Phường Mễ Trì, Quận Nam Từ Liêm, Thành phố Hà Nội</div>
                                <div className="table-responsive cart_info style-purchase">
                                    <table className="table table-condensed">
                                        <tbody>
                                        {this.fetchMedicineList()}
                                        <tr>
                                            <td className="cart_product"></td>
                                            <td className="cart_description"></td>
                                            <td className="cart_price"><label className="total_sub">Tổng tiền:</label></td>
                                            <td className="cart_quantity"><span className="total-price">{this.state.waitingPay.format_total} <sup>đ</sup></span></td>
                                            <td className="cart_delete"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default BillDetail;