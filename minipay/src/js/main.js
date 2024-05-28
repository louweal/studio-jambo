// import { initMiniPayCheckBalance } from './modules/initMiniPayCheckBalance.js';
import { initMiniPayTransaction } from './modules/initMiniPayTransaction.js';
import { initMiniPayConnect } from './modules/initMinipayConnect.js';

// Main thread
(async function () {
    'use strict';
    if (typeof window !== 'undefined' && window.ethereum) {
        _LTracker.push('isMinipay: ' + window.ethereum.isMinipay);
        // if (window.ethereum.isMinipay) {
        _LTracker.push('Minipay detected');

        try {
            let receipt = await initMiniPayTransaction()
                .then(() => {
                    _LTracker.push('then!');
                })
                .catch((error) => {
                    _LTracker.push(error);
                });
            _LTracker.push(receipt);
            _LTracker.push('Done!');
        } catch (error) {
            _LTracker.push(error);
        }
        // } else {
        //     _LTracker.push('Minipay not detected');
        // }
        _LTracker.push('Bye!');
    } else {
        _LTracker.push('Ethereum not detected');
    }

    // await initMiniPayConnect();

    // const walletAddressEl = document.querySelector('.minipay-wallet-address');

    // if (walletAddressEl) {
    //     let walletAddress = walletAddressEl.dataset.address;

    //     //for debugging
    //     walletAddress = '0xe64c095F97A09204E92Ad69e53362fE04ce12303';
    //     console.log(walletAddress);

    //     if (walletAddress.startsWith('0x')) {
    //         await initMiniPayCheckBalance(walletAddress);

    //         initMiniPayTransaction();
    //     } else {
    //         console.log('minipay wallet not detected');
    //     }
    // } else {
    //     console.log('else');
    // }
})();
