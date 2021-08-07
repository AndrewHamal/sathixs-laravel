import React, { useState, useEffect, useRef } from "react";
import axios from 'axios'
import moment from 'moment';
import Echo from 'laravel-echo';
import Pusher from "pusher-js"
import { Popconfirm, message, Button, notification } from 'antd';


const Ticket = () => {

    const [ticket, setTicket] = useState(null)
    const messagesEnd = useRef()

    const [chat, setChat] = useState(null)

    let options = {
        broadcaster: 'pusher',
        key: 'f1420c508647e4f94ca3',
        cluster: 'ap2',
        wsHost: '127.0.0.1',
        wsPort: 6001,
        forceTLS: false,
        encrypted: false,
        disableStats: true,
        enabledTransports: ['ws']
    }

    let echo = new Echo(options);

    useEffect(() => {
        getTickets()
    }, [])

    function getTickets() {

        axios.get('/admin/ticket?type=ajax')
        .then((res) => {
            setTicket(res.data)
            setChat(null)
        })

    }

    const getChat = (id: string) => {
        axios.get('/admin/ticket/'+id)
        .then((res) => {
            setChat(res.data)
            messagesEnd?.current.scrollIntoView();

            echo.channel(`ticket.${res.data[0]?.ticket_id}`)
            .listen('.tickets', (event: any) => {
                getChat(event.message.ticket_id)
            })
        })
    }

    function sendMessage(e: any){
        e.preventDefault()
        let formData = new FormData(e?.target);
        formData.append('_method', 'PATCH');
        axios.post('/admin/ticket/'+chat[0]?.ticket_id, formData)
        .then(res => {
            document.getElementById('form').reset()
        })

    }

    function markAsComplete(id : string){
        return axios.post('/admin/ticket-mark-complete', {
            ticket_id : id
        }).then(res => res.data)
        .catch(err => { throw err })
    }

    function confirm(id : string) {
        markAsComplete(id)
        .then(res => {
            notification.success({message: 'Successfully market as complete!!!'});
            getTickets()
        }).catch(err => {
            notification.success({message: 'Someting went wrong! Please try again'});
        })
    }

    return (
        <div>
        {ticket !== null ?
        <div className="row rounded-lg overflow-hidden shadow">
            {/* Users box*/}
            <div className="col-5 px-0 bg-white">
            <div className="bg-white">
                <div className="bg-gray px-4 py-2 bg-light">
                <p className="h5 mb-0 py-1">Active Tickets</p>
                </div>
                <div className="messages-box">
                <div className="list-group rounded-0">
                {
                    ticket.map((res, i) => (
                        <a className={`list-group-item list-group-item-action rounded-0 ${chat !== null ? chat[0]?.ticket_id === res?.id ? 'active text-white' : '' : ''}`} key={i} onClick={() => getChat(res?.id)}>
                            <div className="media">
                                <div className="media-body">
                                <div className="d-flex align-items-center justify-content-between mb-1">
                                    <div style={{'lineHeight':1}}>
                                        <p className="mb-0" style={{fontWeight: '500'}}>{ res.email }</p>
                                        <small className="text-warning text-lowercase">type: { res.type }</small>
                                    </div>

                                    <small className="small font-weight-light">
                                        {moment(res.created_at).format('MMMM Do')}

                                    </small>
                                    <div>
                                        <Popconfirm placement="topLeft" title={"Are you sure to mark as closed?"} onConfirm={() => confirm(res?.id)} okText="Yes" cancelText="No">
                                            <button className="btn btn-warning rounded-lg btn-sm"> Mark as closed</button>
                                        </Popconfirm>
                                    </div>
                                </div>
                                <small className="font-italic mb-0">{
                                     res.message.substring(0,80)
                                }</small>
                                </div>
                            </div>
                        </a>
                    ))
                }
                </div>
                </div>
            </div>
            </div>
            {/* Chat Box*/}
            <div className="col-7 px-0">
            <div className="px-4 py-5 chat-box bg-white">
                {/* Sender Message*/}

                {
                    chat !== null ? chat.map((res, i) => (
                        res.admin_id !== null ?
                            <div className="media w-50 ml-auto mb-3" key={i}>
                                <div className="media-body">
                                    <div className="bg-primary rounded py-2 px-3 mb-2">
                                    <p className="text-small mb-0 text-white">{ res.message }</p>
                                    </div>
                                    <p className="small text-muted">{moment(res.created_at).format('h:mm a')} | {moment(res.created_at).format('MMMM Do')}</p>
                                </div>
                            </div> :
                            <div className="media w-50 mb-3" key={i}>
                                <div className="media-body">
                                    <div className="bg-light rounded py-2 px-3 mb-2">
                                    <p className="text-small mb-0 text-muted">{ res.message }</p>
                                    </div>
                                    <p className="small text-muted">{moment(res.created_at).format('h:mm a')} | {moment(res.created_at).format('MMMM Do')}</p>
                                </div>
                            </div>
                    )) : ''
                }

            <div style={{ float:"left", clear: "both" }}
                ref={messagesEnd}>
            </div>

            </div>

            {/* Typing area */}
            <form action="#" id="form" onSubmit={(e) => sendMessage(e)} className="bg-light">
                <div className="input-group">
                <input type="text" name="message" required placeholder="Type a message" aria-describedby="button-addon2" className="form-control rounded-0 border-0 py-3 bg-light" />
                <div className="input-group-append">
                    <button id="button-addon2" type="submit" className="btn btn-link h-100"> <i className="fa fa-paper-plane" /></button>
                </div>
                </div>
            </form>
            </div>
        </div> : ''}
        </div>
    );
};

export default Ticket;
