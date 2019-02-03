import React from "react";
import Modal from "./Modal";

class Header extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      monthName: "",
      year: this.props.year,
      showModal: false
    };
  }

  toggleShowModal = event => {
    this.setState({ showModal: !this.state.showModal });
  };

  generateMsg = () => {
    return this.props.msgs[Math.floor(Math.random() * this.props.msgs.length)];
  };

  //TODO: Add in the rest of the month
  static getDerivedStateFromProps({ month, year }) {
    let monthName = "";
    switch (month) {
      case "01":
        monthName = "January";
        break;
      case "02":
        monthName = "February";
        break;
      case "03":
        monthName = "March";
        break;
      case "04":
        monthName = "April";
        break;
      case "05":
        monthName = "May";
        break;
      case "06":
        monthName = "June";
        break;
      case "07":
        monthName = "July";
        break;
      case "08":
        monthName = "August";
        break;
      case "09":
        monthName = "September";
        break;
      case "10":
        monthName = "October";
        break;
      case "11":
        monthName = "November";
        break;
      case "12":
        monthName = "December";
        break;
      default:
        monthName = "unknown";
        break;
    }

    return { monthName, year };
  }
  render() {
    return (
      <div className="header">
        <button id="log">{"Login"}</button>
        <button id="left" onClick={this.props.prevMonth}>
          {"<"}
        </button>
        {`${this.state.monthName}, 
      ${this.state.year}`}
        <button id="right" onClick={this.props.nextMonth}>
          {">"}
        </button>
        <button id="surprise" onClick={this.toggleShowModal}>
          Surprise Me!
        </button>
        {this.state.showModal ? (
          <Modal>
            <button id="closeSurprise" onClick={this.toggleShowModal}>
              X
            </button>
            {this.generateMsg()}
          </Modal>
        ) : null}
      </div>
    );
  }
}

export default Header;
