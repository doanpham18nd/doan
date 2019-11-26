import React, {Component} from 'react';
import axios from "axios";
import MedicineRow from "./MedicineRow";
import {Link, NavLink} from "react-router-dom";

class MedicineList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            medicineList: [],
            totalPage: 1,
            title: '',
        }
    }


    componentDidMount() {
        let string = this.props.match.params.alias;
        let aryMedicine = string.split('-');
        let id = aryMedicine.splice(-1)[0];
        axios.get(window.Laravel.baseUrl + '/api/category/' + id)
            .then(response => {
                if (response.data.status === 1) {
                    document.title = response.data.data.cate_name;
                    this.setState({
                        title: response.data.data.cate_name,
                        medicineList: response.data.data.data,
                        totalPage: response.data.data.last_page
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }


    fetchRows() {
        let medicineList = this.state.medicineList;
        return medicineList.map((object, i) => {
            return <MedicineRow obj={object} key={i} index={i}/>
        })
    }

    paginate = () => {
        if(this.state.totalPage > 1) {
            let ul = [];
            for (let i = 1; i <= this.state.totalPage; i++) {
                ul.push(<li>{i}</li>)
            }
            console.log(ul);
            // return (
            //     <ul className="pagination">
            //         <li className="active"><a href="">1</a></li>
            //         <li><a href="">2</a></li>
            //         <li><a href="">3</a></li>
            //         <li><a href="">&raquo;</a></li>
            //     </ul>
            // )
        }
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-sm-3">
                        <div className="left-sidebar">
                            <h2>Phân loại</h2>
                            <div className="panel-group category-products" id="accordian">
                                <div className="panel panel-default">
                                    <div className="panel-heading">
                                        <h4 className="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear"
                                               className="collapsed">
                                                Loại da
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="sportswear" className="panel-collapse">
                                        <div className="panel-body">
                                            <ul>
                                                <li><a href="">Nhờn </a></li>
                                                <li><a href="">Thường</a></li>
                                                <li><a href="">Khô</a></li>
                                                <li><a href="">Nhạy cảm</a></li>
                                                <li><a href="">Mọi loại da</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div className="panel panel-default">
                                    <div className="panel-heading">
                                        <h4 className="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear" className="collapsed">Chức năng</a>
                                        </h4>
                                    </div>
                                    <div id="sportswear" className="panel-collapse">
                                        <div className="panel-body">
                                            <ul>
                                                <li><NavLink to={'/category/kem-chong-nang-1.html'}>Chống nắng</NavLink></li>
                                                <li><NavLink to={'/category/kem-duong-trang-6.html'}>Trắng da</NavLink></li>
                                                <li><NavLink to={'/category/thuoc-tri-mun-14.html'}>Trị mụn</NavLink></li>
                                                <li><NavLink to={'/category/kem-tri-nam-2.html'}>Trị nám</NavLink></li>
                                                <li><NavLink to={'/category/tay-da-chet-8.html'}>Tẩy da chết</NavLink></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="left-sidebar">
                                <img src="https://hoaanhdao.vn/data/banner/03818098649761ff883bd82f2b3bd1b6.png"
                                     style={{width: 100 + '%', marginTop: 50 + 'px'}}/>
                            </div>
                            <div className="shipping text-center">
                                Gọi mua hàng (07:30-22:30)<br/>
                                1800 7118<br/>
                                Tất cả các ngày trong tuần
                            </div>
                        </div>
                    </div>
                    <div className="col-sm-9">
                        <div className="">
                            <div className="features_items">
                                <h2 className="title text-center">{this.state.title}</h2>
                                {this.fetchRows()}
                            </div>
                            {this.paginate()}
                        </div>
                    </div>

                </div>
            </div>
        );
    }
}

export default MedicineList;