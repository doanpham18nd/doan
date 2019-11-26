import React, {Component} from 'react';

class Row extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <tr>
                <td className="cart_product">
                    <img src={this.props.obj.thumbnail_web} alt=""/>
                </td>
                <td className="cart_description">
                    <p>{this.props.obj.name}</p>
                </td>
                <td className="cart_price">
                    <p>{this.props.obj.format_price}<sup>đ</sup></p>
                </td>
                <td className="cart_quantity">
                    <div className="cart_quantity_button">
                        <span className="fsghbtn" onClick={() => this.props.subCart(this.props.obj.id)}><i>-</i></span>
                        <input className="fs-ghplip" readOnly type="text" name="quantity" value={this.props.obj.quantity}
                               autoComplete="off" size="2"/>
                        <span className="fsghbtn" onClick={() => this.props.addCart(this.props.obj.id)}>+</span>
                    </div>
                </td>
                <td className="cart_delete">
                    <a className="cart_quantity_delete" onClick={() => this.props.deleteCart(this.props.obj.id)}><i className="fa fa-times"/></a>
                </td>
            </tr>
        );
    }
}

export default Row;