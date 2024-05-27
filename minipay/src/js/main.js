import { initMiniPayCheckBalance } from './modules/initMiniPayCheckBalance.js';
import { initMiniPayTransaction } from './modules/initMiniPayTransaction.js';
import { initMiniPayConnect } from './modules/initMinipayConnect.js';

// Main thread
(async function () {
    'use strict';

    await initMiniPayConnect();

    const walletAddressEl = document.querySelector('.minipay-wallet-address');
    let walletAddress = walletAddressEl.dataset.address;

    //for debugging
    walletAddress = '0xe64c095F97A09204E92Ad69e53362fE04ce12303';
    console.log(walletAddress);

    if (walletAddress.startsWith('0x')) {
        await initMiniPayCheckBalance(walletAddress);
    } else {
        console.log('minipay wallet not detected');
    }
})();
