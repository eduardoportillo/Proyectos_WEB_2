import React, { Component } from 'react'
import { Text, View } from 'react-native'
import { connect } from 'react-redux';
import { SPopup } from 'servisofts-component';
import user from '../Components/user';
const host = "127.0.0.1"
const port = "8000"
const URL = "http://" + host + ":" + port + "/";
var INSTANCE = null;
class SHttp extends Component {
    static api = URL + "api/";
    static img = URL;
    static PROP;

    static async get(data, param) {
        this.send(data, "GET", param);
    }
    static async post(data) {
        this.send(data, "POST");
    }

    static async send(data, type, param) {
        data.estado = "cargando";
        SHttp.dispatch(data);
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        var usrLog = user.Actions.validateSession(null, true);
        if (usrLog) {
            if (usrLog.access_token) {
                myHeaders.append("Authorization", "Bearer " + usrLog.access_token);
            }
        }

        var requestOptions = {
            method: type,
            headers: myHeaders,
            body: JSON.stringify(data.data),
            redirect: 'follow',
        };
        var paramsGet = ""
        if (type == "GET") {
            delete requestOptions["body"]
            if (param) {
                if (param.length > 0) {
                    paramsGet = "/" + param
                }
            }
            if (data.data) {
                paramsGet += "?" + Object.keys(data.data).map(function (key) {
                    return encodeURIComponent(key) + "=" + encodeURIComponent(data.data[key]);
                });
            }
        }
        var url = SHttp.api + data.component + "/" + data.type + paramsGet;
        console.log("HTTP send:: ", type + "::", url);
        fetch(url, requestOptions)
            .then(async (response) => {
                // console.log("HTTP response ::->", data.component, data.type, response);
                if (!response.ok) {
                    data.estado = "error";
                    data.error = response.statusText;
                    SHttp.dispatch(data);
                    return null;
                }
                var json = await response.json();
                console.log("HTTP response ::->", data.component, data.type, json);
                data.estado = "exito";
                return json;
            })
            .then(result => {
                data.data = result;
                SHttp.dispatch(data);
            })
            .catch((error) => {
                console.log('error', error)
                data.estado = "error";
                data.error = error;
                SHttp.dispatch(data);
            });
    }
    static getState() {
        return INSTANCE.state;
    }
    static dispatch(data) {
        // console.log("dispatch", data);
        return INSTANCE.dispatch(data);
    }
    constructor(props) {
        super(props);
        INSTANCE = props;
        this.state = {
        }
    }
    render() {
        INSTANCE = this.props;
        return (
            this.props.children
        )
    }
}

const initStates = (state) => {
    return { state }
};
export default connect(initStates)(SHttp);