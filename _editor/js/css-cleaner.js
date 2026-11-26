// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/* Keep in sync with classes/local/css_cleaner.php. Shared fixtures cover both implementations. */
function cleanCertificateCss(css) {
    // Scan structural delimiters only, never inside comments, strings, escapes or functions.
    function scan(start, end, block) {
        let braces = 0;
        let parens = 0;
        let brackets = 0;
        for (let i = start; i < end; i++) {
            const ch = css[i];
            if (ch === "\\") {
                if (++i === end) {
                    return -1;
                }
                continue;
            }
            if (ch === "/" && css[i + 1] === "*") {
                const close = css.indexOf("*/", i + 2);
                if (close < 0 || close + 2 > end) {
                    return -1;
                }
                i = close + 1;
                continue;
            }
            if (ch === '"' || ch === "'") {
                const quote = ch;
                do {
                    i++;
                    if (css[i] === "\\") {
                        i++;
                    } else if (css[i] === quote) {
                        break;
                    }
                } while (i < end);
                if (i >= end) {
                    return -1;
                }
                continue;
            }
            if (ch === "(") {
                parens++;
            } else if (ch === ")") {
                if (--parens < 0) {
                    return -1;
                }
            } else if (ch === "[") {
                brackets++;
            } else if (ch === "]") {
                if (--brackets < 0) {
                    return -1;
                }
            } else if (!parens && !brackets) {
                if (!block && (ch === "{" || ch === ";")) {
                    return i;
                }
                if (ch === "{") {
                    braces++;
                } else if (ch === "}") {
                    if (!block) {
                        return -1;
                    }
                    if (!braces) {
                        return i;
                    }
                    braces--;
                }
            }
        }
        return -1;
    }

    function rules(start, end, depth) {
        if (depth > 32) {
            return null;
        }
        const output = [];
        const wrapper = /^\[data-gjs-type[ \t\r\n\f]*=[ \t\r\n\f]*(?:"wrapper"|'wrapper'|wrapper)[ \t\r\n\f]*\]/;
        let pos = start;
        while (pos < end) {
            // Preserve leading whitespace and comments independently of any removed rule.
            const trivia = pos;
            while (pos < end) {
                if (/[ \t\r\n\f]/.test(css[pos])) {
                    pos++;
                } else if (css[pos] === "/" && css[pos + 1] === "*") {
                    const close = css.indexOf("*/", pos + 2);
                    if (close < 0 || close + 2 > end) {
                        return null;
                    }
                    pos = close + 2;
                } else {
                    break;
                }
            }
            output.push(css.slice(trivia, pos));
            if (pos === end) {
                break;
            }
            const delimiter = scan(pos, end, false);
            if (delimiter < 0) {
                return null;
            }
            if (css[delimiter] === ";") {
                output.push(css.slice(pos, delimiter + 1));
                pos = delimiter + 1;
                continue;
            }
            const close = scan(delimiter + 1, end, true);
            if (close < 0) {
                return null;
            }
            const raw = css.slice(pos, delimiter);
            const selector = raw.replace(/[ \t\r\n\f]+$/, "");
            const suffix = raw.slice(selector.length);
            let remove = selector === "body" || selector === "*";
            let normalized = selector;
            const match = wrapper.exec(selector);
            // Only normalize individual wrapper selectors, not grouped selectors or strings.
            if (match && selector.indexOf(",") === -1) {
                const rest = selector.slice(match[0].length);
                if (/^[ \t\r\n\f]*>[ \t\r\n\f]*div[ \t\r\n\f]+\*$/.test(rest)) {
                    remove = true;
                } else {
                    const child = /^[ \t\r\n\f]*>[ \t\r\n\f]*(#[\s\S]+)$/.exec(rest);
                    const descendant = /^[ \t\r\n\f]+([^>+~ \t\r\n\f][\s\S]*)$/.exec(rest);
                    const candidate = child ? child[1] : descendant ? descendant[1] : "";
                    if (candidate && candidate !== "body" && candidate !== "*" &&
                            candidate.slice(0, 2) !== "/*" && !wrapper.test(candidate)) {
                        normalized = candidate;
                    }
                }
            }
            if (!remove) {
                if (/^@(media|supports|layer|container|document|scope|starting-style)(?=[ \t\r\n\f(]|$)/i.test(selector)) {
                    const nested = rules(delimiter + 1, close, depth + 1);
                    if (nested === null) {
                        return null;
                    }
                    output.push(raw, "{", nested, "}");
                } else {
                    output.push(normalized, suffix, css.slice(delimiter, close + 1));
                }
            }
            pos = close + 1;
        }
        return output.join("");
    }

    const result = rules(0, css.length, 0);
    // A malformed or excessively nested input must never be partially rewritten.
    return result === null ? css : result;
}

if (typeof module === "object" && module.exports) {
    module.exports = cleanCertificateCss;
}
