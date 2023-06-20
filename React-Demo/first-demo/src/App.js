import AboutUs from "./Components/AboutUs";
import Alert from "./Components/Alert";
import Navbar from "./Components/Navbar";
import TextForm from "./Components/TextForm";
import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
//14
function App() {
  const [mode, setMode] = useState("light");
  const [alert, setAlert] = useState(null);

  const toggleMode = () => {
    if (mode === "light") {
      setMode("dark");
      document.body.style.backgroundColor = "#042743";
      showAlert("success", "Enable Dark Mode");
    } else {
      setMode("light");
      document.body.style.backgroundColor = "white";
      showAlert("success", "Enable Light Mode");
    }
  };

  const showAlert = (type, message) => {
    setAlert({
      type: type,
      message: message,
    });

    setTimeout(() => {
      setAlert(null);
    }, 2000);
  };

  return (
    <Router>
      <>
        <Navbar
          title="Textutils"
          about="About us"
          mode={mode}
          togglemode={toggleMode}
        />
        <Alert alert={alert} />
        <div className="container my-3">
          <Routes>
            <Route
              exact
              path="/"
              element={
                <TextForm
                  heading="Enter string and perform diffrent opperation on it"
                  mode={mode}
                  showalert={showAlert}
                />
              }
            />

            <Route
              exact
              path="/about-us"
              element={
                <AboutUs
                  heading="Accordion Used for Change Theame"
                  mode={mode}
                />
              }
            />
          </Routes>
        </div>
      </>
    </Router>
  );
}

export default App;
