// Import modules.
import { initMenuToggle } from "./modules/initMenuToggle";
import { initScrollClass } from "./modules/initScrollClass";
import { initSubmenuToggle } from "./modules/initSubmenuToggle";

// Main thread
(function () {
    "use strict";

    // Use modules
    initMenuToggle();
    initSubmenuToggle();
    initScrollClass();
})();
