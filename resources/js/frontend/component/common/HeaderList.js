import React, {Component} from 'react';
import {Link, NavLink} from "react-router-dom";

class HeaderList extends Component {
    constructor(props) {
        super(props);
    }

    checkActive = (path) => {
        if (location.pathname === path) {
            return 'active'
        }
        return  '';
    };

    render() {
        return (
            <li><a className={this.checkActive('/category/' + this.props.obj.alias + '-' + this.props.obj.id + '.html')} href={'/category/' + this.props.obj.alias + '-' + this.props.obj.id + '.html'}>{this.props.obj.name}</a></li>
        );
    }
}

export default HeaderList;