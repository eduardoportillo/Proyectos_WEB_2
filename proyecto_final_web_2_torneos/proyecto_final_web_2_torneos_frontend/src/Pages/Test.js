import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SHr, SIcon, SPage, SText, STheme, SView } from 'servisofts-component';
const Code = (code) => {
    return (
        <SView card style={{
            padding: 8,
        }} center col={"xs-12"}>
            <SText color={STheme.color.lightBlack} fontSize={12} center>{code.children}</SText>
        </SView>
    );
}
class Test extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    getEnfermeras() {
        var cantidad = Array.from(Array(27).keys())
        return cantidad.map((obj, i) => {
            return <SView height={500} width={200} center style={{
                padding: 8,
            }}>
                <SIcon name={`Enfermera${i + 1}`} width={"100%"} fill={"#f0f"} />
                <SText color={""}>{`Enfermera${i + 1}`}</SText>
                <Code >{`  <SIcon name={\`Enfermera${i + 1}\`} width={100%} fill={"#f0f"} />`}</Code>
            </SView>
        })
    }
    render() {
        return (
            <SPage title={'Test'}>
                <SView col={"xs-12"} center >

                <SText ></SText>
                    <SView col={"xs-11"} row>
                        <SHr height={20} />

                        <SHr height={50} />
                        <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} >
                            <SText backgroundColor={STheme.color.primary} height={50} fontSize={18} center font={"LondonTwo"}>Primary {`\n${STheme.color.primary}`}</SText>
                            <Code >{`<SText backgroundColor={STheme.color.primary} height={50} fontSize={18} center font={"LondonTwo"}>primary</SText>`}</Code>
                            <SHr height={50} />
                        </SView>
             
                        <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} >
                            <SText height={50} fontSize={18} center font={"LondonTwo"} backgroundColor={STheme.color.info}>info {`\n${STheme.color.info}`}</SText>
                            <Code >{`<SText height={50} center font={"LondonTwo"} fontSize={18} backgroundColor={STheme.color.info}>info</SText>`}</Code>
                            <SHr height={50} />
                        </SView>
                        <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} >
                            <SText backgroundColor={STheme.color.black} height={50} fontSize={18} center font={"LondonTwo"}>black {`\n${STheme.color.black}`}</SText>
                            <Code >{`<SText backgroundColor={STheme.color.black} height={50} fontSize={18} center font={"LondonTwo"}>black</SText>`}</Code>
                            <SHr height={50} />
                        </SView>
                        <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} >
                            <SText backgroundColor={STheme.color.lightGray} height={50} fontSize={18} center font={"LondonTwo"}>lightGray {`\n${STheme.color.lightGray}`}</SText>
                            <Code >{`<SText backgroundColor={STheme.color.lightGray} height={50} fontSize={18} center font={"LondonTwo"}>lightGray</SText>`}</Code>
                            <SHr height={50} />
                        </SView>
                        <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} >
                            <SText backgroundColor={STheme.color.danger} height={50} center fontSize={18} font={"LondonTwo"}>danger {`\n${STheme.color.danger}`}</SText>
                            <Code >{`<SText backgroundColor={STheme.color.danger} height={50} fontSize={18} center font={"LondonTwo"}>danger</SText>`}</Code>
                            <SHr height={50} />
                        </SView>
                        <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} >
                            <SText backgroundColor={STheme.color.warning} height={50} center fontSize={18} font={"LondonTwo"}>warning {`\n${STheme.color.warning}`}</SText>
                            <Code >{`<SText backgroundColor={STheme.color.warning} height={50} fontSize={18} center font={"LondonTwo"}>warning</SText>`}</Code>
                            <SHr height={50} />
                        </SView>
                        <SHr />
                        <SHr />
                        <SView col={"xs-6"}>
                            <SText fontSize={20} color={STheme.color.black} height={50} center font={"LondonTwo"}>LondonTwo</SText>
                            <SHr />
                            <SText fontSize={20} color={STheme.color.black} height={50} center font={"LondonBetween"}>LondonBetween</SText>
                            <SHr />
                            <SText fontSize={20} color={STheme.color.black} height={50} center font={"LondonMM"}>LondonMM</SText>
                            <SHr />
                        </SView>
                        <SView col={"xs-6"}>
                            <SView>

                            </SView>
                            <SHr />
                            <SText fontSize={20} color={STheme.color.black} height={50} center font={"LondonBetween"}>LondonBetween</SText>
                            <SHr />
                            <SText fontSize={20} color={STheme.color.black} height={50} center font={"LondonMM"}>LondonMM</SText>
                            <SHr />
                        </SView>

                        <SView col={"xs-12"}>
                            <SIcon name={"Logo"} />
                            <Code >{`<SIcon name={"Logo"} />`}</Code>
                            <SHr height={50} />
                            <SIcon name={"Logo"} width={200} />
                            <Code >{`<SIcon name={"Logo"} width={200}  />`}</Code>
                            <SHr height={50} />
                            <SView col={"xs-12"} center>
                                <SIcon name={"Logo"} width={200} />
                            </SView>
                            <Code >{`
                            <SView col={"xs-12"} center>
                                <SIcon name={"Logo"} width={200} />
                            </SView>
                        `}</Code>
                            <SHr height={50} />
                            <SView col={"xs-12"} center row>
                                <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} center>
                                    <SIcon name={"Logo"} width={"100%"} />
                                </SView>
                                <SView col={"xs-12 md-6 xl-4"} style={{ padding: 8 }} center>
                                    <SIcon name={"Logo"} width={"100%"} />
                                </SView>
                            </SView>
                            <Code >{`
                            <SView col={"xs-12"} center row>
                                <SView col={"xs-12 md-6 xl-4"} style={{ padding:8}} center>
                                    <SIcon name={"Logo"} width={"100%"} />
                                </SView>
                                <SView col={"xs-12 md-6 xl-4"} style={{ padding:8}} center>
                                    <SIcon name={"Logo"} width={"100%"} />
                                </SView>
                            </SView>
                        `}</Code>
                            <SHr height={50} />
                        </SView>
                    </SView>

                </SView>
            </SPage>
        );
    }
}
const initStates = (state) => {
    return { state }
};
export default connect(initStates)(Test);