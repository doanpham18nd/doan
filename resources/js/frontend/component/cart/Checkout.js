import React, {Component} from 'react';

class Checkout extends Component {
    constructor(props) {
        super(props);
    }
    render() {
        return (
            <section id="do_action">
                <div className="container">
                        <div className="col-sm-12">
                            <div className="total_area">
                                <ul>
                                    <li>Tạm tính <span>{this.props.total}<sup>đ</sup></span></li>
                                    <li>Phí vận chuyển <span>0<sup>đ</sup></span></li>
                                    <li>Tổng tiền <span>{this.props.total}</span></li>
                                </ul>
                                <a className="btn btn-default update" href="">Update</a>
                                <a className="btn btn-default check_out" href="">Check Out</a>
                            </div>
                        </div>
                    </div>
            </section>
        );
    }
}

export default Checkout;