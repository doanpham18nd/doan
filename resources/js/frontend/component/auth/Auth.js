import React, {Component} from 'react';
import {post} from "axios";

class Auth extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errorFlg:false,
            errorMsg: '',
            userId: ''
        }
    }

    handleFieldChange(event) {
        this.setState({
            [event.target.name]: event.target.value,
        });
    }
    showError = () => {
        if(this.state.errorFlg) {
            return (
                <p className="text-danger">{this.state.errorMsg}</p>
            )
        }
    };

    handleSubmit = (e) => {
        e.preventDefault();
        const {history} = this.props;
        if (localStorage.getItem('userId')) {
            this.setState({
                userId: localStorage.getItem('userId')
            })
        }
        this.uploadData(this.state).then((response) => {
            if (response.data.status === 1) {
                localStorage.setItem('user', JSON.stringify(response.data.data));
                if(localStorage.getItem('userId')) {
                    localStorage.removeItem('userId');
                    history.push('/gio-hang.html');
                } else {
                    history.push('/');
                }
            } else {
                this.setState({
                    errorFlg:true,
                    errorMsg: response.data.error
                });
            }
        })
    };

    uploadData = (data) => {
        const url = '/api/login';
        const config = {
            'content-type': 'multipart/form-data'
        };
        return post(url, data, config)
    };


    render() {
        return (
            <section id="form">
                <div>
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-4 col-sm-offset-1">
                                <div className="login-form">
                                    <h2>Bạn đã có tài khoản</h2>
                                    <form onSubmit={(event) => this.handleSubmit(event)}>
                                        <input type="text" name="email" placeholder="Tài khoản" onChange={(event) => this.handleFieldChange(event)}/>
                                        <input type="password" name="password" placeholder="Mật khẩu" onChange={(event) => this.handleFieldChange(event)}/>
                                        {this.showError()}
                                        <span/>
                                        <button type="submit" className="btn btn-default">Đăng nhập</button>
                                    </form>
                                </div>
                            </div>
                            <div className="col-sm-1">
                                <h2 className="or">OR</h2>
                            </div>
                            <div className="col-sm-4">
                                <div className="signup-form">
                                    <h2>Tạo tài khoản mới</h2>
                                    <form action="#">
                                        <input type="text" placeholder="Name"/>
                                        <input type="email" placeholder="Email Address"/>
                                        <input type="password" placeholder="Password"/>
                                        <button type="submit" className="btn btn-default">Đăng ký</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Auth;