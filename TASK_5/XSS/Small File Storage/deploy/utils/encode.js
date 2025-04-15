const customUrlEncode = (data, charsToEncode = ['?', '/', '#']) => {
    const regex = new RegExp(charsToEncode.map(char => `\\${char}`).join('|'), 'g');
    return data.replace(regex, match => encodeURIComponent(match));
}

module.exports = {
    customUrlEncode
}