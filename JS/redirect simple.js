/*
jQuery is not necessary, and window.location.replace(...) will best simulate an HTTP redirect.

window.location.replace(...) is better than using window.location.href, because replace() does not keep the originating page in the session history, meaning the user won't get stuck in a never-ending back-button fiasco.

    If you want to simulate someone clicking on a link, use location.href

    If you want to simulate an HTTP redirect, use location.replace

For example:
*/

// similar behavior as an HTTP redirect
window.location.replace("http://stackoverflow.com");

// similar behavior as clicking on a link
window.location.href = "http://stackoverflow.com";