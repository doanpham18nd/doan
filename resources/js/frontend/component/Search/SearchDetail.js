import React, {Component} from 'react';
import {NavLink} from "react-router-dom";

class SearchDetail extends Component {
    render() {
        return (
            <div className="col-sm-3">
                <div className="product-image-wrapper">
                    <div className="single-products">
                        <div className="productinfo text-center">
                            <a href={'/' + this.props.obj.alias + '-' + this.props.obj.id + '.html'}>
                                <img src={this.props.obj.thumbnail_web} alt=""/>
                                <p>{this.props.obj.name}</p>
                            </a>
                            <h4>{this.props.obj.format_price} VNĐ</h4>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default SearchDetail;