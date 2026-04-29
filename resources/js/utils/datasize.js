/**
 *
 * @param {string} size
 * @return {number}
 */
export function convertFileSizeToBytes(size) {
    const sizeLetter = size.slice(-1).toLowerCase();
    const sizeInt = parseInt(size.slice(0, -1));
    let multiplier = 1024;

    if (!['k', 'm', 'g'].includes(sizeLetter)) {
        throw new Error(`Size type of ${sizeLetter} is not supported`)
    }

    if (sizeLetter === 'k') {
        multiplier = 1024;
    }

    if (sizeLetter === 'm') {
        multiplier = 1024 ** 2;
    }

    if (sizeLetter === 'g') {
        multiplier = 1024 ** 3;
    }

    return sizeInt * multiplier;
}
