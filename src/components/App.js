import React, { Component } from "react";
import Header from "./Header";
import Result from "./Result";
import $ from "jquery";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      year: "",
      month: "",
      days: [],
      activeDay: { day: "", month: "", year: "" },
      showModal: false
    };
    this.toggleModal.bind(this);
  }

  daysInMonth = (month, year) => {
    // Use 1 for January, 2 for February, etc.
    return new Date(year, month, 0).getDate();
  };

  toggleModal = () => {
    this.setState({ showModal: !this.state.showModal });
  };

  prevMonth = () => {
    let p_year,
      p_month,
      p_days,
      p_daysArr = [];
    if (this.state.month === "01") {
      p_year = parseInt(this.state.year) - 1;
      p_year = p_year + "";
      p_month = "12";
    } else {
      p_year = this.state.year;
      p_month = parseInt(this.state.month) - 1;
      p_month = p_month + "";
      if (p_month < 10) {
        p_month = "0".concat(p_month);
        console.log(p_month);
      }
    }
    p_days = this.daysInMonth(p_month, p_year) - this.state.days.length;
    for (let i = 0; i < p_days + this.state.days.length; i++) {
      p_daysArr.push(i);
    }

    this.setState({ year: p_year, month: p_month, days: p_daysArr });
  };

  nextMonth = () => {
    let p_year,
      p_month,
      p_days,
      p_daysArr = [];
    if (this.state.month === "12") {
      p_year = parseInt(this.state.year) + 1;
      p_year = p_year + "";
      p_month = "01";
    } else {
      p_year = this.state.year;
      p_month = parseInt(this.state.month) + 1;
      p_month = p_month + "";
      if (p_month < 10) {
        p_month = "0".concat(p_month);
        console.log(p_month);
      }
    }
    p_days = this.daysInMonth(p_month, p_year) - this.state.days.length;
    for (let i = 0; i < p_days + this.state.days.length; i++) {
      p_daysArr.push(i);
    }

    this.setState({ year: p_year, month: p_month, days: p_daysArr });
  };

  //get number of days, write for loop to generate x
  componentDidMount() {
    $.ajax({
      url: "ajax.php",
      data: "",
      type: "GET",
      dataType: "json",
      success: function(json) {
        console.log(json);
      }
    });
    let date = new Date();
    let numDays,
      daysArr = [];

    date = JSON.stringify(date)
      .substring(1, 11)
      .split("-");
    numDays = this.daysInMonth(date[1], date[0]);

    //this will change to the array the backend sends us
    for (let i = 0; i < numDays; i++) {
      daysArr.push(i);
    }

    this.setState({
      year: date[0],
      month: date[1],
      days: daysArr,
      activeDay: { day: date[2], month: date[1], year: date[0] }
    });
  }

  //add in a prop for being disabled?

  render() {
    return (
      <>
        <div className="container">
          <Header
            month={this.state.month}
            year={this.state.year}
            prevMonth={this.prevMonth}
            nextMonth={this.nextMonth}
          />
          <Result
            year={this.state.year}
            month={this.state.month}
            days={this.state.days}
            activeDay={this.state.activeDay}
            showModal={this.state.showModal}
            toggleModal={this.toggleModal}
          />
        </div>
      </>
    );
  }
}

export default App;
