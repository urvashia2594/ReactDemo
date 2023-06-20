import React, { useState } from "react";

export default function TextForm(prop) {
  const handleUpdatedText = (event) => {
    setText(event.target.value);
  };

  const converTextToUp = (event) => {
    let newText = text.toUpperCase();
    setText(newText);
    prop.showalert("success", "Text Converted to Uppercase");
  };

  const converTextToLo = (event) => {
    let newText = text.toLowerCase();
    setText(newText);
    prop.showalert("success", "Text Converted to Lowercase");
  };

  const removeWhitespace = (event) => {
    let newText = text.trim().split(/ +/).join(" ");
    setText(newText);
    prop.showalert("success", "White Space Removed From text");
  };

  const clearText = (event) => {
    let newText = "";
    setText(newText);
    prop.showalert("success", "Clear Text");
  };

  const [text, setText] = useState("");
  return (
    <div>
      <div
        className="container"
        style={{
          color: prop.mode === "light" ? "black" : "white",
        }}
      >
        <h1>{prop.heading}</h1>
        <div className="mb-3">
          <textarea
            className="form-control"
            value={text}
            id="myBox"
            rows="10"
            onChange={handleUpdatedText}
            style={{
              backgroundColor: prop.mode === "light" ? "white" : "#13466e",
              color: prop.mode === "light" ? "black" : "white",
              border: "solid",
            }}
          ></textarea>
        </div>
        <button
          disabled={text.length === 0}
          className="btn btn-primary"
          onClick={converTextToUp}
        >
          Convert to Uppercase
        </button>
        <button
          disabled={text.length === 0}
          className="btn btn-primary mx-2"
          onClick={converTextToLo}
        >
          Convert to Lowercase
        </button>
        <button
          disabled={text.length === 0}
          className="btn btn-primary mx-2"
          onClick={removeWhitespace}
        >
          Remove White Space
        </button>
        <button
          disabled={text.length === 0}
          className="btn btn-primary mx-2"
          onClick={clearText}
        >
          Clear Text
        </button>
      </div>
      <div
        className="container my-3"
        style={{
          color: prop.mode === "light" ? "black" : "white",
        }}
      >
        <h2>Your Text Summary</h2>
        <p>
          <b>
            {
              text.split(/\s+/).filter((element) => {
                return element.length != 0;
              }).length
            }
          </b>{" "}
          words and <b>{text.length}</b> character
        </p>
        <h2>Preview</h2>
        <p>
          {console.log("hi" + text.length)}
          {text.length > 0
            ? text
            : "Enter something in above textbox to preview it"}
        </p>
      </div>
    </div>
  );
}
