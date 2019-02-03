import React from "react";

class Header extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      monthName: "",
      year: this.props.year
    };
  }

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
        <button onClick={this.props.prevMonth}>{"<"}</button>
        {`${this.state.monthName}, 
      ${this.state.year}`}
        <button onClick={this.props.nextMonth}>{">"}</button>
      </div>
    );
  }
}

export default Header;
