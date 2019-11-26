import React, {Component} from 'react';
import {NavLink} from "react-router-dom";

class DealHot extends Component {
    render() {
        return (
            <div className="col-sm-4">
                <div className="product-image-wrapper">
                    <div className="single-products">
                        <div className="productinfo text-center img-responsive">
                            <NavLink className="active" to={this.props.obj.alias+ '-' + this.props.obj.id + '.html'}><img src={this.props.obj.thumbnail_web} alt=""/>
                                <p>{this.props.obj.name}</p></NavLink>
                            <h4>{this.props.obj.format_price}<sup>đ</sup></h4>
                            {/*<a href="#" className="btn btn-default add-to-cart"><i*/}
                            {/*    className={"fa fa-shopping-cart"}/>Thêm vào giỏ hàng</a>*/}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default DealHot;