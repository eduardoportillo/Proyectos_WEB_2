import React from 'react';
import { View, Text } from 'react-native';


//---------REDUX----------
import Reducer from './Reducer';
import { createStore, applyMiddleware } from 'redux';
import { Provider } from 'react-redux';
import reduxThunk from 'redux-thunk';
import Home from './Pages/Home';
import SConfig from './SConfig';
import { SComponentContainer, SNavigation } from 'servisofts-component';
import Pages from './Pages';
import Assets from './Assets';
//------------------------
import SHttp from './SHttp';
const store = createStore(
    Reducer,
    {},
    applyMiddleware(reduxThunk),
);

const App = (props) => {

    return (
        <Provider store={store}>
            <SHttp>
                <SComponentContainer
                    debug
                    assets={Assets}
                    theme={{ initialTheme: "dark", themes: SConfig.SThemeProps }}>
                    <SNavigation props={{
                        prefixes: ["https://component.servisofts.com", "component.servisofts://"],
                        pages: Pages,
                    }} />

                </SComponentContainer>
            </SHttp >
        </Provider>
    )
}
export default App;