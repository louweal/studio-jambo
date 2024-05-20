import { initMiniPayConnect } from "./modules/initMiniPayConnect.js";

// Main thread
(function () {
    "use strict";
    console.log("hello from minipay plugin");

    initMiniPayConnect();
})();
