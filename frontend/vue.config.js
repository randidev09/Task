module.exports = {
    // options...
    devServer: {
        disableHostCheck: true,
        host: 'localhost',
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept'
        },
        watchOptions: {
            poll: true
        },
        proxy: 'http://localhost/',
    } 
}