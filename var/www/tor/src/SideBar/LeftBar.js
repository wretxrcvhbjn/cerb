import React from 'react';
//import SideBarTitle from './SideBarTitle';
import SideBarMenu from './SideBarMenu';

// Наше меню слева
const LeftBar = () => (
    <nav id="sidebar">
        {/* <SideBarTitle title="Cerberus v2" /> */}
        <SideBarMenu />{/** Именно меню */}
    </nav>
);

export default LeftBar;
