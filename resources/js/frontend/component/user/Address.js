import React, {Component} from 'react';
import Menu from "./Menu";
import AddressRow from "./AddressRow";
import axios from "axios";

class Address extends Component {
    constructor(props) {
        super(props);
        this.state = {
            user : JSON.parse(localStorage.getItem('user')),
            addressDetail: {},
            province : [],
            district : [],
            ward : []
        }
    }

    componentDidMount() {
        axios.get('/api/province').then(response => {
            this.setState({
                province: response.data.data,
            })
        }).catch(error => {
            console.log(error)
        });
    }

    fetchAddress = () => {
        return this.state.user.address.map((object, i) => {
            return <AddressRow obj={object} key={i}
                               name={this.state.user.username}
                               editAddress={(id) => this.editAddress(id)}
                               index={i}
                               phone={this.state.user.phone} />
        })
    };

    editAddress = (id) => {
        this.setState({
            addressDetail: this.state.user.address[id]
        });
        axios.get('/api/district/' + this.state.user.address[id].province_id).then(res => {
            this.setState({
                district: res.data.data
            })
        });
        axios.get('/api/ward/' + this.state.user.address[id].district_id).then(res => {
            this.setState({
                ward: res.data.data
            })
        });
        $('#myModal').modal('show');
    };

    getProvince = () => {
        return this.state.province.map((object, i) => {
            return <option key={i} value={object.province_id}>{object.name}</option>
        })
    };

    getDistrict = () => {
        return this.state.district.map((object, i) => {
            return <option key={i} value={object.district_id}>{object.name}</option>
        })
    };

    getWard = () => {
        return this.state.ward.map((object, i) => {
            return <option key={i} value={object.ward_id}>{object.name}</option>
        })
    };

    render() {
        return (
            <div className="container">
                <div className="row">
                    <Menu/>
                    <div className="col-sm-9">
                        <div className="">
                            <div className="features_items">
                                <h2 className="title text-center">Địa chỉ</h2>
                                {this.fetchAddress()}
                                {/* modal */}
                                <div className="modal fade" id="myModal" role="dialog">
                                    <div className="modal-dialog">
                                        <div className="modal-content">
                                            <div className="modal-header">
                                                <button type="button" className="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 className="modal-title">Chỉnh sửa địa chỉ</h4>
                                            </div>
                                            <div className="modal-body">
                                                <form>
                                                    <div className="form-group row">
                                                        <label htmlFor="username"
                                                               className="col-sm-2 col-form-label margin-top">Tên</label>
                                                        <div className="col-sm-10">
                                                            <input type="text" className="form-control" name="username" id="username" readOnly defaultValue={this.state.user.username}/>
                                                        </div>
                                                    </div>
                                                    <div className="form-group row">
                                                        <label htmlFor="inputPassword"
                                                               className="col-sm-2 col-form-label margin-top">Điện thoại</label>
                                                        <div className="col-sm-10">
                                                            <input type="text" className="form-control" id="inputPassword" readOnly defaultValue={this.state.user.phone} name="phone"/>
                                                        </div>
                                                    </div>
                                                    <div className="form-group row">
                                                        <label htmlFor="inputPassword"
                                                               className="col-sm-2 col-form-label margin-top">Thành phố</label>
                                                        <div className="col-sm-10">
                                                            <select className="form-control" id="province" name="province_id" value={this.state.addressDetail.province_id}>
                                                                {this.getProvince()}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div className="form-group row">
                                                        <label htmlFor="inputPassword"
                                                               className="col-sm-2 col-form-label margin-top">Quận</label>
                                                        <div className="col-sm-10">
                                                            <select className="form-control" id="district" name="district_id" value={this.state.addressDetail.district_id}>
                                                                {this.getDistrict()}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div className="form-group row">
                                                        <label htmlFor="inputPassword"
                                                               className="col-sm-2 col-form-label margin-top">Phường</label>
                                                        <div className="col-sm-10">
                                                            <select className="form-control" id="ward" name="ward_id" value={this.state.addressDetail.ward_id}>
                                                                {this.getWard()}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div className="form-group row">
                                                        <label htmlFor="inputPassword"
                                                               className="col-sm-2 col-form-label margin-top">Địa chỉ</label>
                                                        <div className="col-sm-10">
                                                            <input type="text" className="form-control" id="inputPassword"
                                                                   defaultValue={this.state.addressDetail.address} name="address"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div className="modal-footer">
                                                <button type="button" className="btn btn-primary">Lưu
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        );
    }
}

export default Address;