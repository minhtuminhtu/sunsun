$(function() {
    let init_event = 0;
    window.onpopstate = function(event) {
        //alert(`location: ${document.location}, state: ${JSON.stringify(event.state.confirm)}`)
        console.log(event.state.confirm)
        if ( (event.state.confirm === false) && (init_event !== 0)) {
            // alert("nothing!");
        } else {
            init_event++;
            history.forward();
        }
        history.forward();
    }
    history.pushState({confirm: false}, "Not checked", "");
    history.pushState({confirm: true}, "Checked", "");
    history.back();
});
