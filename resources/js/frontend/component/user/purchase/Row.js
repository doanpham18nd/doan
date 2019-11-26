import React, {Component} from 'react';
import RowDetail from "./RowDetail";
import {Link} from "react-router-dom";
import axios from "axios";

class Row extends Component {
    constructor(props) {
        super(props);
    }

    fetchMedicineList = () => {
        return this.props.obj.bill_detail.map((object, i) => {
            return <RowDetail obj={object} key={i}/>
        })
    };

    cancelOrder = (id) => {
        // data = {};
        // data.id = id;
      axios.post('/api/cart/cancel', id).then(res => {
          window.location.replace('/user/cancel.html')
      }).catch(error => {
          window.location.replace('/user/cancel.html')

      })
    };

    checkCancel = () => {
        if(this.props.obj.status == 0) {
            return <button className="btn btn-primary" onClick={() => {this.cancelOrder(this.props.obj.id)}} style={{marginTop:0 + 'px'}}>Hủy đơn hàng</button>
        }
    };

    render() {

        return (
            <div className="table-responsive cart_info style-purchase">
                <table className="table table-condensed">
                    <tbody>
                    {this.fetchMedicineList()}
                    <tr>
                        <td className="cart_product"></td>
                        <td className="cart_description"></td>
                        <td className="cart_price"><label className="total_sub">Tổng tiền:</label></td>
                        <td className="cart_quantity"><span className="total-price">{this.props.obj.format_total} <sup>đ</sup></span></td>
                        <td className="cart_delete"></td>
                    </tr>
                    <tr>
                        <td className="cart_product"></td>
                        <td className="cart_description"></td>
                        <td className="cart_price">{this.checkCancel()}</td>
                        <td className="cart_quantity"><Link className="btn btn-default" to={'/user/bill/detail/' + this.props.obj.id}>Xem chi tiết</Link></td>
                        <td className="cart_delete"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        );
    }
}

export default Row;
