import React, { Component } from "react";
import Header from "./Header";
import Result from "./Result";
import $ from "jquery";

var msgs = [
  "I met my online friend in real life today!-2019/02/02",
  "I ate tasty potatoes today-2019/02/01"
];

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      year: "",
      month: "",
      days: [],
      activeDay: { day: "", month: "", year: "" },
      showModal: false,
      currMsg: ""
    };
    this.toggleModal.bind(this);
  }

  daysInMonth = (month, year) => {
    // Use 1 for January, 2 for February, etc.
    return new Date(year, month, 0).getDate();
  };

  toggleModal = e => {
    if (
      parseInt(e.target.dataset.id) === parseInt(this.state.activeDay.day) &&
      this.state.month === this.state.activeDay.month
    )
      this.setState({ showModal: !this.state.showModal });
    else if (this.state.showModal)
      this.setState({ showModal: !this.state.showModal });
  };
  onChange = e => {
    this.setState({ currMsg: e.target.value });
  };

  onSubmit = e => {
    e.preventDefault();
    console.log(this.state.currMsg);
    msgs.push(
      `${this.state.currMsg}-${this.state.activeDay.year}/${
        this.state.activeDay.month
      }/${this.state.activeDay.day}`
    );
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
    // $.ajax({
    //   url: "ajax.php",
    //   data: "",
    //   type: "GET",
    //   dataType: "json",
    //   success: function(json) {
    //     console.log(json);
    //   }
    // });

    let dataURL = "http://localhost/McHacks/src/index.php";
    let h = new Headers();
    let req = new Request(dataURL, {
      headers: h,
      method: "GET",
      mode: "no-cors"
    });
    fetch(req)
      .then(response => {
        console.log(response + "success");
      })
      .catch(err => {
        console.log(err);
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
            msgs={msgs}
          />
          <Result
            year={this.state.year}
            month={this.state.month}
            days={this.state.days}
            activeDay={this.state.activeDay}
            showModal={this.state.showModal}
            toggleModal={this.toggleModal}
            onChange={this.onChange}
            onSubmit={this.onSubmit}
          />
        </div>
      </>
    );
  }
}

export default App;
