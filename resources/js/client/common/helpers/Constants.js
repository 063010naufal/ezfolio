const Constants = {
    TRUE: 1,
    FALSE: 0,

    //error status
    STATUS_CODE_SUCCESS: 200,
    STATUS_CODE_BAD_REQUEST: 400,
    STATUS_CODE_UNAUTHORIZED: 401,
    STATUS_CODE_NOT_FOUND: 404,
    STATUS_CODE_ERROR: 500,

    //custom error status
    TOKEN_INVALID: 'token_invalid',
    TOKEN_EXPIRED: 'token_expired',
    TOKEN_BLACKLISTED: 'token_blacklisted',
    TOKEN_NOT_FOUND: 'token_not_found',

    settings: {
        SITE_NAME: 1,
        ACCENT_COLOR: 2,
        SHORT_MENU: 3,
        LOGO: 4,
        FAVICON: 5,
        COVER: 6,
        MENU_LAYOUT: 7,
        MENU_COLOR: 8,
        NAV_COLOR: 9,
    },

    portfolioConfig: {
        TEMPLATE: 1,
        ACCENT_COLOR: 2,
        GOOGLE_ANALYTICS_ID: 3,
        MAINTENANCE_MODE: 4,
        MENU_ABOUT: 5,
        MENU_SKILL: 6,
        MENU_EDUCATION: 7,
        MENU_EXPERIENCE: 8,
        MENU_PROJECT: 9,
        MENU_SERVICE: 10,
        MENU_CONTACT: 11,
        MENU_FOOTER: 12,
        SCRIPT_HEADER: 13,
        SCRIPT_FOOTER: 14,
    }
}

export default Constants;