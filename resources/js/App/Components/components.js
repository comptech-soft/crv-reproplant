const components = {

    /**
     * Layout components
     */
    'app-main': require('./Layout/Main'),
    'app-footer': require('./Layout/Footer/Footer'),
    'sub-header': require('./Layout/Body/Wrapper/Header/Header'),

    'quick-sidebar': require('./Layout/QuickSidebar'),
    'scroll-top': require('./Layout/ScrollTop'),
    'quick-nav': require('./Layout/QuickNav'),

    /**
     * Composed components
     */
    'alert-box': require('./../../App/Components/Commons/Composed/Alert/Alert'),
    'form-box': require('./../../App/Components/Commons/Composed/Form/Form'),
    'modal-box': require('./../../App/Components/Commons/Composed/Modal/Modal'),

     /**
     * Controls
     */
    'textbox': require('./../../App/Components/Commons/Controls/Text/Textbox'),
    'number-box': require('./../../App/Components/Commons/Controls/Text/Number'),
    'passwordbox': require('./../../App/Components/Commons/Controls/Text/Passwordbox'),
    'icheckbox': require('./../../App/Components/Commons/Controls/Options/iCheckbox'),
    'summernote': require('./../../App/Components/Commons/Controls/Edit/Summernote'),
    'simple-select': require('./../../App/Components/Commons/Controls/Select/Simple'),
    'year-select': require('./../../App/Components/Commons/Controls/Select/Year'),
    'two-select': require('./../../App/Components/Commons/Controls/Select/Two'),
    'editbox': require('./../../App/Components/Commons/Controls/Edit/Edit'),
    'datebox': require('./../../App/Components/Commons/Controls/Text/Date'),
    'vue-image': require('./../../App/Components/Commons/Controls/Images/Image'),
    'vue-uploader': require('./../../App/Components/Commons/Controls/Images/ImageUploader'),
}

module.exports = components