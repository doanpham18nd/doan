import React, {Component} from 'react';
import {Link} from "react-router-dom";

class NewArticle extends Component {
    render() {
        return (
            <div className="col-sm-4">
                <div className="single-blog-spot text-center">
                    <div className="productinfo">
                        <Link to={'/article/' + this.props.obj.alias + '-' + this.props.obj.id + '.html'}>
                            <img className="index-img" src={this.props.obj.thumbnail_web} alt={this.props.obj.name}/>
                        </Link>
                        <p>{this.props.obj.title}</p>
                    </div>
                </div>
            </div>
        );
    }
}

export default NewArticle;