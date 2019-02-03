import React, { Component } from "react";
import Header from "./Header";
import Result from "./Result";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      year: "",
      month: "",
      days: [],
      activeDay: "",
      showModal: false
    };
    this.toggleModal.bind(this);
  }
  daysInMonth = (month, year) => {
    // Use 1 for January, 2 for February, etc.
    return new Date(year, month, 0).getDate();
  };

  toggleModal = () => {
    console.log(this.state.showModal);
    this.setState({ showModal: !this.state.showModal });
  };

  //get number of days, write for loop to generate x
  componentDidMount() {
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
      activeDay: date[2]
    });
  }

  //add in a prop for being disabled?

  render() {
    return (
      <>
        <div className="container">
          <Header month={this.state.month} year={this.state.year} />
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
