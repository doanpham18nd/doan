import React, {Component} from 'react';
import axios from "axios";
import ReactDOM from "react-dom";

export default class NewChat extends Component {

    constructor(props) {
        super(props);
        this.state = {
            data: []
        }

    }

    componentDidMount() {
        axios.get('/api/user').then(res => {
            this.setState({
                data: res.data.data
            })
        }).catch(error => {
            console.log(error);
        })
    }

    fetchRows = () => {
        return this.state.data.map((object, i) => {
            return (
                <tr key={i}>
                    <td>{i + 1}</td>
                    <td>{object.username}</td>
                    <td>{object.email}</td>
                    <td>{object.phone}</td>
                    <td>Tòa nhà Sông Đà, Phường Mễ Trì, Quận Nam Từ Liêm, Thành phố Hà Nội<br/>
                        Tòa nhà Sudico, Phường Mễ Trì, Quận Nam Từ Liêm, Thành phố Hà Nội
                    </td>
                    <td><button className="btn btn-primary" onClick={() => this.newChat(object.id)}>Nhắn tin</button></td>
                    {/*<td><button className="btn btn-primary">Chi tiết</button></td>*/}
                </tr>
            )
        })
    };

    newChat = (id) => {
        axios.post(window.Laravel.baseUrl + '/admin/new-chat/' + id).then(res => {

        }).catch( error => {

        })
    };

    render() {
        return (
            <table className="table table-bordered text-center">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th colSpan="2"/>
                </tr>
                </thead>
                <tbody>
                {this.fetchRows()}
                </tbody>
            </table>
        );
    }
}

if (document.getElementById('new-chat')) {
    ReactDOM.render(<NewChat />, document.getElementById('new-chat'));
}
