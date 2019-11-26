import React, {Component} from 'react';
import PopupNotification from "./PopupNotification";
import PopupMessage from "./PopupMessage";
import Search from "./Search";
import ReactDOM from "react-dom";
import axios from "axios";

class Header extends Component {

    constructor(props) {
        super(props);
        this.state = {
            messages2: [],
            patientId: 0,
            showForm: false
        }

    }

    componentDidMount() {
        axios.get(window.Laravel.baseUrl + '/api/message')
            .then(response => {
                if (response.data.status === 1) {
                    this.setState({
                        messages2: response.data.data.data,
                        unRead: response.data.data.count
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            });
        Echo.channel('new-chat').listen('Chat', (e) => {
            if (e.message.patient_id != this.state.patientId) {
                axios.get(window.Laravel.baseUrl + '/admin/message')
                    .then(response => {
                        if (response.data.status === 1) {
                            this.setState({
                                messages2: response.data.data.data,
                                unRead: response.data.data.count
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            } else {
                axios.get(window.Laravel.baseUrl + '/admin/message')
                    .then(response => {
                        if (response.data.status === 1) {
                            this.setState({
                                messages2: response.data.data.data,
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        });
        Echo.channel('read').listen('Read', (e) => {
            axios.get(window.Laravel.baseUrl + '/admin/message')
                .then(response => {
                    if (response.data.status === 1) {
                        this.setState({
                            messages2: response.data.data.data,
                            unRead: response.data.data.count,
                            patientId: e.patientId,
                            showForm: true

                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        })
    }

    showPopupNotification() {
        return <PopupNotification/>
    };

    getUserId(id) {
        axios.post(window.Laravel.baseUrl + '/admin/message/read/' + id).then(function (res) {
            // axios.get(window.Laravel.baseUrl + '/admin/message')
            //     .then(response => {
            //         if (response.data.status === 1) {
            //             self.setState({
            //                 messages2: response.data.data.data,
            //                 unRead: response.data.data.count
            //             })
            //         }
            //     })
            //     .catch(function (error) {
            //         console.log(error)
            //     });
        }).catch(function (err) {
            console.log(err)
        });
    };


    showPopupMessage() {
        return <PopupMessage
            openForm={() => this.props.openForm()}
            getUserId={(id) => this.getUserId(id)}
            messageData={this.state.messages2}
            unRead={this.state.unRead}
        />
    };

    showSearch() {
        return <Search/>
    };

    render() {
        return (
            <nav className="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" className="btn btn-link d-md-none rounded-circle mr-3">
                    <i className="fa fa-bars"/>
                </button>

                <form
                    className="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div className="input-group">
                        <input type="text" className="form-control bg-light border-0 small" placeholder="Search for..."
                               aria-label="Search" aria-describedby="basic-addon2"/>
                        <div className="input-group-append">
                            <button className="btn btn-primary" type="button">
                                <i className="fas fa-search fa-sm"/>
                            </button>
                        </div>
                    </div>
                </form>

                <ul className="navbar-nav ml-auto">

                    {this.showSearch()}

                    {this.showPopupNotification()}
                    {this.showPopupMessage()}

                    <div className="topbar-divider d-none d-sm-block"/>

                    <li className="nav-item dropdown no-arrow">
                        <a className="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span className="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                            <img className="img-profile rounded-circle"
                                 src="https://source.unsplash.com/QAB-WJcbgJk/60x60"/>
                        </a>

                        <div className="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a className="dropdown-item" href="#">
                                <i className="fas fa-user fa-sm fa-fw mr-2 text-gray-400"/>
                                Profile
                            </a>
                            <a className="dropdown-item" href="#">
                                <i className="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"/>
                                Settings
                            </a>
                            <a className="dropdown-item" href="#">
                                <i className="fas fa-list fa-sm fa-fw mr-2 text-gray-400"/>
                                Activity Log
                            </a>
                            <div className="dropdown-divider"/>
                            <a className="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i className="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"/>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
        );
    }
}

export default Header;

if (document.getElementById('header')) {
    ReactDOM.render(<Header/>, document.getElementById('header'));
}