import React, {Component} from 'react';

class AddressRow extends Component {
    render() {
        return (
            <div className="address-card">
                <div className="address-display__left">
                    <div
                        className="address-display__field-container address-display__field-container--name">
                        <div className="address-display__field-label">Tên</div>
                        <div className="address-display__field-content"><span
                            className="address-display__name-text">{this.props.name}</span></div>
                    </div>
                    <div className="address-display__field-container">
                        <div className="address-display__field-label">Số điện thoại</div>
                        <div className="address-display__field-content">{this.props.phone}</div>
                    </div>
                    <div className="address-display__field-container">
                        <div className="address-display__field-label">Địa chỉ</div>
                        <div className="address-display__field-content"><span>{this.props.obj.address + ', ' + this.props.obj.ward_name + ', ' + this.props.obj.district_name + ', ' + this.props.obj.province_name}</span>
                        </div>
                    </div>
                </div>
                <div className="address-card__buttons">
                    <div className="address-card__button-group">
                        <button className="bacc-secondary-action-btn" data-toggle="modal" onClick={() => this.props.editAddress(this.props.index)}>Sửa</button>
                        <button className="bacc-secondary-action-btn">Xóa</button>
                    </div>
                </div>
            </div>
        );
    }
}

export default AddressRow;