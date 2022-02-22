toggleSideDrawer = () => {
    if (document.getElementById("side-drawer").classList.contains("hidden")) {
        openSideDrawer();
    }
    else {
        closeSideDrawer();
    }
}

openSideDrawer = () => {
    const sideDrawer = document.getElementById("side-drawer");
    
    sideDrawer.classList.remove("hidden");
    // sideDrawer.classList.add("animate__animated");
    // sideDrawer.classList.add("animate__fadeInLeftBig");
    // sideDrawer.classList.add("animate__faster");

    // sideDrawer.addEventListener('animationend', () => {
    //     sideDrawer.classList.remove("animate__animated");
    //     sideDrawer.classList.remove("animate__fadeInLeftBig");
    //     sideDrawer.classList.add("animate__faster");
    // }, { once: true });
}

closeSideDrawer = () => {
    const sideDrawer = document.getElementById("side-drawer");
    
    // sideDrawer.classList.add("animate__animated");
    // sideDrawer.classList.add("animate__fadeOutLeftBig");
    // sideDrawer.classList.add("animate__faster");

    sideDrawer.classList.add("hidden");
    // sideDrawer.addEventListener('animationend', () => {
    //     sideDrawer.classList.add("hidden");
    //     sideDrawer.classList.remove("animate__animated");
    //     sideDrawer.classList.remove("animate__fadeOutLeftBig");
    //     sideDrawer.classList.add("animate__faster");
    // }, { once: true });
}
