import React, {Component} from 'react';
import {NavLink} from "react-router-dom";

class RowDetail extends Component {
    render() {
        return (
            <tr>
                <td className="cart_product cart_bill"><img src={this.props.obj.image_thumbnail} alt=""/></td>
                <td className="cart_description">
                    <NavLink to={'/' + this.props.obj.alias + '-' + this.props.obj.medicine_id + '.html'}>
                        <p>{this.props.obj.medicine_name}</p>
                    </NavLink>
                    <span>x {this.props.obj.quantity}</span></td>
                <td className="cart_price"></td>
                <td className="cart_quantity"><p>{this.props.obj.format_price}<sup>đ</sup></p>
                </td>
                <td className="cart_delete">
                    {/*<a className="cart_quantity_delete"><i className="fa fa-times"></i></a>*/}
                </td>
            </tr>
        );
    }
}

export default RowDetail;