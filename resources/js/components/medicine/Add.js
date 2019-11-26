import CKEditor from "react-ckeditor-component";
import React, {Component} from 'react'
import {post} from 'axios/index';
import CategoryOption from "./categoryOption";
import axios from "axios/index";

const form = {
    width: '100%'
}

class Add extends Component {
    constructor(props) {
        super(props);
        this.state = {
            content: ''
        };
        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.handleCreateNewProject = this.handleCreateNewProject.bind(this);
        this.handleEditorChange = this.handleEditorChange.bind(this);
    }

    componentDidMount() {
        axios.get(window.Laravel.baseUrl + '/api/category')
            .then(response => {
                if (response.data.status === 1) {
                    this.setState(response.data.data)
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    handleFieldChange(event) {
        this.setState({
            [event.target.name]: event.target.value,
        });
    }

    handleEditorChange(evt) {
        let newContent = evt.editor.getData();
        this.setState({
            content: newContent
        })

    }

    fileChangedHandler = (event) => {
        this.setState({thumbnail: event.target.files[0]})
    };

    handleCreateNewProject(event) {
        event.preventDefault();
        const {history} = this.props;

        this.uploadData(this.state).then((response) => {
            if (response.data.status == 1) {
                history.push('/admin/medicine');
            } else {
                alert(response.data.error);
            }
        })
    }

    uploadData = (data) => {
        const url = '/api/medicine';
        const formData = new FormData();
        for (let key in data) formData.append(key, data[key]);
        const config = {
            'content-type': 'multipart/form-data'
        };
        return post(url, formData, config)
    };

    search = (event) => {
        const {target: {value}} = event;
        this.setState({
            scheduleDay: value
        });
    };

    makeCategoryList() {
        if (this.state.category1 instanceof Array) {
            return this.state.category1.map((object, i) => {
                return <CategoryOption obj={object} key={i} index={i}/>
            })
        }
    }

    makeCategoryList2() {
        if (this.state.category2 instanceof Array) {
            return this.state.category2.map((object, i) => {
                return <CategoryOption obj={object} key={i} index={i}/>
            })
        }
    }

    makeCategoryList3() {
        if (this.state.category3 instanceof Array) {
            return this.state.category3.map((object, i) => {
                return <CategoryOption obj={object} key={i} index={i}/>
            })
        }
    }

    render() {
        return (
            <div className="card shadow mb-4">
                <div className="card-header py-3 text-center">
                    <h1 className="m-0 font-weight-bold text-primary">Thêm mới thuốc</h1>
                </div>
                <div className="card-body">
                    <div className="row">
                        <form onSubmit={this.handleCreateNewProject} encType="multipart/form-data" style={form}>
                            <div className="col-lg-12">
                                <div className="mb-4 py-3">
                                    <label htmlFor="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" className="form-control" id="name" name="name"
                                           onChange={this.handleFieldChange}/>
                                </div>

                                <div className="mb-4 py-3">
                                    <label htmlFor="">Thumbnail</label>
                                    <input type="file" className="form-control" id="thumbnailUpdate"
                                           name="thumbnailUpdate"
                                           onChange={this.fileChangedHandler}/>
                                </div>

                                <div className="mb-4 py-3">
                                    <label htmlFor="exampleInputEmail1">Giá</label>
                                    <input type="text" className="form-control" id="price" name="price"
                                           onChange={this.handleFieldChange}/>
                                </div>
                                <div className="mb-4 py-3">
                                    <label htmlFor="exampleInputEmail1">Danh mục sản phẩm</label>
                                    <select className="form-control" name="category" id="category"
                                            onChange={this.handleFieldChange}>
                                        {this.makeCategoryList()}
                                        {this.makeCategoryList2()}
                                        {this.makeCategoryList3()}
                                    </select>
                                </div>
                            </div>

                            <div className="col-lg-12">

                                <div className="mb-4 py-3 ">
                                </div>
                            </div>
                            <div className="col-lg-12">
                                <div className="mb-4 py-3">
                                    <label htmlFor="editor1">Nội dung tóm tắt</label>
                                    <textarea className="form-control" name="short_content" rows="5"
                                              onChange={this.handleFieldChange}/>
                                </div>
                            </div>
                            <div className="col-lg-12">
                                <div className="mb-4 py-3">
                                    <label htmlFor="editor1">Mô tả sản phẩm</label>
                                    <CKEditor
                                        activeClass="p10"
                                        content={this.state.content}
                                        events={{
                                            "blur": this.onBlur,
                                            "afterPaste": this.afterPaste,
                                            "change": this.handleEditorChange
                                        }}
                                    />

                                </div>
                            </div>
                            <div className="col-lg-12 text-center">
                                <button type="submit" className="btn btn-primary ">Thêm mới</button>
                                {/*<button type="reset" className="btn btn-danger ">Hủy bỏ</button>*/}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Add