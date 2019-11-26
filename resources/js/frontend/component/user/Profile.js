import React, {Component} from 'react';
import Menu from "./Menu";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

class Profile extends Component {
    constructor(props) {
        super(props);
        this.state = {
            date: new Date('01-01-1990'),
            user: {},
        };

    }

    componentDidMount() {
        let user = JSON.parse(localStorage.getItem('user'));
        this.setState({
            user: user,
        });
        if(user.birthday !== undefined) {
            let date = new Date(user.birthday);
            console.log(date);
            this.setState({
                date: date
            })
        }
    }

    handleChange = (date) => {
        this.setState({
            date: date
        });
    };

    handleValue = (event) => {
        this.setState({
            [event.target.name]: event.target.value
        })
    };
    checked = (value) => {
        if (this.state.user.sex === value) {
            return 'checked';
        }
    };

    render() {
        return (
            <div className="container" style={{marginBottom: 80 + 'px'}}>
                <div className="row">
                    <Menu/>
                    <div className="col-sm-9">
                        <div className="col-sm-9">
                            <div className="row">
                                <div className="features_items">
                                    <h2 className="title text-center">Profile</h2>
                                    <form>
                                        <div className="form-group row">
                                            <label htmlFor="username"
                                                   className="col-sm-2 col-form-label margin-top">Tên</label>
                                            <div className="col-sm-10">
                                                <input type="text" className="form-control" name="username" id="username" defaultValue={this.state.user.username}/>
                                            </div>
                                        </div>
                                        <div className="form-group row">
                                            <label htmlFor="staticEmail"
                                                   className="col-sm-2 col-form-label margin-top">Email</label>
                                            <div className="col-sm-10">
                                                <input type="text" className="form-control" name="email"
                                                       readOnly id="staticEmail" defaultValue={this.state.user.email}/>
                                            </div>
                                        </div>
                                        <div className="form-group row">
                                            <label htmlFor="inputPassword"
                                                   className="col-sm-2 col-form-label margin-top">Ngày sinh</label>
                                            <div className="col-sm-10">
                                                <DatePicker
                                                    dateFormat="dd-MM-yyyy"
                                                    selected={this.state.date}
                                                    onChange={this.handleChange}
                                                    className="form-control"
                                                />
                                            </div>
                                        </div>
                                        <div className="form-group row">
                                            <label htmlFor="inputPassword"
                                                   className="col-sm-2 col-form-label margin-top">Điện thoại</label>
                                            <div className="col-sm-10">
                                                <input type="text" className="form-control" id="inputPassword" defaultValue={this.state.user.phone} name="phone"/>
                                            </div>
                                        </div>
                                        <div className="form-group row">
                                            <label htmlFor="sex"
                                                   className="col-sm-2 col-form-label" style={{marginTop: 20 + 'px'}}>Giới
                                                tính</label>
                                            <div className="col-sm-10 form-check-input">
                                                <div className="radio">
                                                    <label><input type="radio" name="sex" value='1'
                                                                  defaultChecked={this.checked(1)}
                                                                  onChange={(event) => this.handleValue(event)}/> Nam</label>
                                                </div>
                                                <div className="radio">
                                                    <label><input name="sex" type="radio" value='0'
                                                                  defaultChecked={this.checked(0)}
                                                                  onChange={(event) => this.handleValue(event)}/> Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="form-group row">
                                            <label htmlFor="sex"
                                                   className="col-sm-2 col-form-label"/>
                                            <div className="col-sm-10">
                                                <input className="btn btn-primary" type="submit" name="submit" value="Lưu" style={{ width: 115 + 'px'}}/>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-3 text-center">
                            <div className="image">
                                <img src={''}/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        );
    }
}

export default Profile;