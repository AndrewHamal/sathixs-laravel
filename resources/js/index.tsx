import React from "react";
import { render } from "react-dom";
import Ticket from "./components/ticket";
import Pusher from "pusher-js"
import 'antd/dist/antd.css';

window.Pusher = Pusher
render(<Ticket />, document.getElementById("app"));
