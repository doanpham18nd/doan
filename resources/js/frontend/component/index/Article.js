import React, {Component} from 'react';
import {Link} from "react-router-dom";

class Article extends Component {
    render() {
        return (
            <div className="col-sm-6">
                <div className="post-product">
                    <div className="single-products">
                        <div className="productinfo text-center">
                            <Link to={'/article/' + this.props.obj.alias + '-' + this.props.obj.id + '.html'}><img src={this.props.obj.thumbnail_web} alt={this.props.obj.name}/></Link>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Article;