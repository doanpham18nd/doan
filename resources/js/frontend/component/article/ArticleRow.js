import React, {Component} from 'react';
import {NavLink} from "react-router-dom";

class ArticleRow extends Component {
    render() {
        return (
            <div className='col-sm-6 min-height'>
                <div className="single-blog-post">
                    <NavLink to={'/article/' + this.props.obj.alias + '-' + this.props.obj.id + '.html'}><h3 className='title1 text-center'>{this.props.obj.title}</h3></NavLink>
                    <NavLink to={'/article/' + this.props.obj.alias + '-' + this.props.obj.id + '.html'}>
                        <img src={this.props.obj.thumbnail_web} alt={this.props.obj.title}/>
                    </NavLink>
                    <p>{this.props.obj.short_content}</p>
                </div>
            </div>
        );
    }
}

export default ArticleRow;