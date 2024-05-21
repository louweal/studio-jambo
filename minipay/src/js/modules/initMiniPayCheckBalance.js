const { getContract, formatEther, createPublicClient, http } = require('viem');
const { celoAlfajores } = require('viem/chains');
const { stableTokenABI } = require('@celo/abis');

const STABLE_TOKEN_ADDRESS = '0x874069fa1eb16d44d622f2e0ca25eea172369bc1';

export const initMiniPayCheckBalance = async function initMiniPayCheckBalance(walletAddress) {
    const debugEl = document.querySelector('.wp-block-group.debug p');
    const balanceEl = document.querySelector('.wp-block-group.balance p');

    balanceEl.innerHTML = 'balance...';

    console.log('in if');
    const publicClient = createPublicClient({
        chain: celoAlfajores,
        transport: http(),
    });

    let balance = await checkCUSDBalance(publicClient, walletAddress); // In Ether unit
    balanceEl.innerHTML = balance;
};

async function checkCUSDBalance(publicClient, address) {
    let StableTokenContract = getContract({
        abi: stableTokenABI,
        address: STABLE_TOKEN_ADDRESS,
        publicClient,
    });

    let balanceInBigNumber = await StableTokenContract.read.balanceOf([address]);

    let balanceInWei = balanceInBigNumber.toString();

    let balanceInEthers = formatEther(balanceInWei);

    return balanceInEthers;
}
