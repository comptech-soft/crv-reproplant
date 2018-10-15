export default {

    data() {
        return {

            /**
             * The Datatable Manager Object
             */
            dt: null,

            /**
             * The Actions Manager Object 
             *    1) am.record = recordul de pe randul click-uit cu valorile initiale
             */
            am: null,

            /**
             * The current tab showed
             */
            current_tab: 'list',

            /**
             * Form Manager : childrenul cu indice 1 are formManager
             * record: childrenul cu indice 1 are record
             * Vezi: init()
             */
            formManager: null,
            record: {},
        }
    },

}