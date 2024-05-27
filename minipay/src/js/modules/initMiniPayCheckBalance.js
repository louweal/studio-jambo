const { getContract, formatEther, createPublicClient, http } = require('viem');
const { celoAlfajores } = require('viem/chains');
const { stableTokenABI } = require('@celo/abis');

const STABLE_TOKEN_ADDRESS = '0x874069fa1eb16d44d622f2e0ca25eea172369bc1';

export const initMiniPayCheckBalance = async function initMiniPayCheckBalance(walletAddress) {
    const minipayDiv = document.querySelector(`div.minipay`);
    if (!minipayDiv) return;
    // Create a new balance div
    var balanceDiv = document.createElement('div');
    balanceDiv.classList.add('minipay-balance');
    minipayDiv.appendChild(balanceDiv);

    let balance = await checkCUSDBalance(walletAddress); // In Ether unit
    balanceDiv.innerText = 'Current balance: ' + balance + ' cUSD.';
};

async function checkCUSDBalance(address) {
    const publicClient = createPublicClient({
        chain: celoAlfajores,
        transport: http(),
    });

    let StableTokenContract = getContract({
        abi: stableTokenABI,
        address: STABLE_TOKEN_ADDRESS,
        publicClient,
    });

    // Ensure the contract is initialized correctly
    if (!StableTokenContract || !StableTokenContract.read || !StableTokenContract.read.balanceOf) {
        throw new Error('Contract is not initialized correctly or balanceOf function is not available');
    }

    let balanceInBigNumber = await StableTokenContract.read.balanceOf([address]);
    let balanceInWei = balanceInBigNumber.toString();
    let balanceInEthers = formatEther(balanceInWei);
    return balanceInEthers;
}
