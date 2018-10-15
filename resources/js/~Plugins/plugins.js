try 
{
    window.Popper = require('popper.js').default
    window.$ = window.jQuery = require('jquery')
    require('bootstrap')
    require('jquery-confirm')
    require('block-ui')
    window.PerfectScrollbar = require('perfect-scrollbar').default
} 
catch(e)
{
    console.log('========== plugins.js ==========')
    console.error(e)
    console.log('==============================')
}