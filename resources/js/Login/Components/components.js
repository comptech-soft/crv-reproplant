const components = {

    /**
     * Layout component
     */
    'app-login': require('./Layout/Login'),

    /**
     * Composed components
     */
    'alert-box': require('./../../App/Components/Commons/Composed/Alert/Alert'),
    'form-box': require('./../../App/Components/Commons/Composed/Form/Form'),

    /**
     * Controls
     */
    'textbox': require('./../../App/Components/Commons/Controls/Text/Textbox'),
    'passwordbox': require('./../../App/Components/Commons/Controls/Text/Passwordbox'),
    'checkbox': require('./../../App/Components/Commons/Controls/Options/Checkbox'),
}

module.exports = components