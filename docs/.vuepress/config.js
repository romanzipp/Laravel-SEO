module.exports = {
    base: '/Laravel-SEO/',
    title: 'Laravel SEO',
    description: 'SEO package made for maximum customization and flexibility ',
    host: 'localhost',
    port: 3001,
    themeConfig: {
        nav: [
            { text: 'Home', link: '/' },
            { text: 'GitHub', link: 'https://github.com/romanzipp/Laravel-SEO' },
            { text: 'Packagist', link: 'https://packagist.org/packages/romanzipp/laravel-seo' },
        ],
        sidebar: [
            '/',
            '/getting-started',
            '/structs',
            '/hooks',
            '/laravel-mix',
            '/example-app',
        ],
        displayAllHeaders: true,
        sidebarDepth: 2
    }
};
