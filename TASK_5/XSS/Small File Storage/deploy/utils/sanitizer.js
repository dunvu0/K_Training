const createDOMPurify = require('dompurify');
const { JSDOM } = require('jsdom');
const window = new JSDOM('').window;
const DOMPurify = createDOMPurify(window);

const sanitizeContent = (text) => {
    return DOMPurify.sanitize(text, {
        FORBID_TAGS: [
             'html',
             'script',
             'iframe',
             'a',
             'head',
             'area',
             'br',
             'p',
             'article',
             'body',
             'b',
             'pre',
             'title',
             'meta',
             'big',
             'style',
             'audio',
             'table',
             'font',
             'div',
             'h1',
             'aside',
             'header',
             'abbr',
             'img',
             'textarea',
             'button']
    });
};

module.exports = {
    sanitizeContent
};