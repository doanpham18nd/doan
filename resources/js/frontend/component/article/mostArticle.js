import React, {Component} from 'react';
import {Link} from "react-router-dom";

class MostArticle extends Component {
    render() {
        return (
            <div className="panel-group category-products col-md-12">
                <Link to={/article/ + this.props.obj.alias + '-' + this.props.obj.id + '.html'}>
                <div className="col-lg-5 no-padding">
                    <img src={this.props.obj.thumbnail_web} width="120"/>
                </div>
                <div className="col-lg-7">
                    <p className='title2'>{this.props.obj.title}</p>
                </div>
                </Link>
            </div>
        );
    }
}

export default MostArticle;