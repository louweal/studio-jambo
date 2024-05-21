import { initMiniPayCheckBalance } from './modules/initMiniPayCheckBalance.js';
import { initMiniPayConnect } from './modules/initMinipayConnect.js';

// Main thread
(async function () {
    'use strict';

    await initMiniPayConnect();

    const walletAddressEl = document.querySelector('.wp-block-group.walletAddress p');
    let walletAddress = walletAddressEl.innerHTML;

    console.log(walletAddress);

    if (walletAddress.startsWith('0x')) {
        await initMiniPayCheckBalance(); // run if address startswith...
    } else {
        console.log('minipay wallet not detected');
    }
})();
