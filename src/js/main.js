// Import modules.
import { initMenuToggle } from "./modules/initMenuToggle";
import { initScrollClass } from "./modules/initScrollClass";
import { initSliders } from "./modules/initSliders";
import { initSubmenuToggle } from "./modules/initSubmenuToggle";
import AOS from "aos";

// Main thread
(function () {
    "use strict";

    // Use modules
    initMenuToggle();
    initSubmenuToggle();
    initScrollClass();
    initSliders();

    AOS.init({
        duration: 600,
        once: true,
        offset: 0,
        easing: "ease-in-out-cubic",
    });
})();
