// resources/assets/js/components/UserRow.js

import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import axios from 'axios/index'

class Row extends Component {
    constructor(props) {
        super(props);
        this.handleDelete = this.handleDelete.bind(this)
    }

    handleDelete(e) {
        e.preventDefault()
        if (!confirm('Are your sure you want to delete this item?')) {
            return false
        }
        let url = window.Laravel.baseUrl + '/api/medicine/' + this.props.obj.id;
        axios.delete(url)
            .then(response => {
                this.props.deleteRow(this.props.index)
            })
            .catch(function (error) {
                console.log(error)
            })
    }

    render() {
        return (
            <tr>
                <td>
                    {this.props.obj.id}
                </td>
                <td>
                    {this.props.obj.name}
                </td>
                <td>
                    <img className="img-thumbnail" src={this.props.obj.thumbnail_app} alt={this.props.obj.name}/>
                </td>
                <td>
                    {this.props.obj.short_content}
                </td>
                <td>
                    {this.props.obj.category_name}
                </td>
                <td>
                    <Link className='btn btn-primary' to={'/admin/medicine/edit/' + this.props.obj.id}>Edit</Link>
                </td>
                <td>
                    <button className='btn btn-danger' onClick={this.handleDelete}>Delete</button>
                </td>
            </tr>
        )
    }
}

export default Row