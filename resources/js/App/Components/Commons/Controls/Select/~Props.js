module.exports = {
    
    props:
    {
        label: {default: null},
        readonly: {default: false},
        disabled: {default: false},
        options: {default: () => []},
        ajax: {default: null},
        reload: {default: 0},
        no_selection_text: {default: '---'}
    },
    
}