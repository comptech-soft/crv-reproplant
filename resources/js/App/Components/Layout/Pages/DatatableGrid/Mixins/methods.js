import AppCore from 'comptechsoft-app-starter'

module.exports = {

    methods: {

        onToolbarClick(e)
        {
            if(e.name == 'insert')
            {
                return this.showForm('insert', null)
            }
        },

        onRowClick(e)
        {
            if( (e.name == 'update') || (e.name == 'delete') )
            {
                return this.showForm(e.name, e.record)
            }
        },

        onRefresh() {
            this.dt.populate()
        },

        onClickAction(action) {
            action.click()
        },

        showGrid(with_refresh = true)
        {
            /**
             * resetez erorile in Form Manager
             */
            if(this.formManager)
            {
                this.formManager.errors = null
            }
            /**
             * Resetez actiunea si recordul
             */
            this.am.setAction(null).setRecord(null)

            /**
             * Populez tabela
             */
            if(with_refresh)
            {
                this.dt.populate()
            }
            
            /**
             * Afisez
             */
            this.current_tab='list'
        },

        setRecordValues(record, action) {
            _.map(this.record, (value, field) => this.record[field] = record[field])
            /**
             * daca in componenta specifica (cea cu controalele, ex. View/Animals/Animals/Form)
             * avem metoda setRecordValues atunci ea se va apela
             */
            if( _.isFunction(this.$children[1].$children[0].setRecordValues ) )
            {
                this.$children[1].$children[0].setRecordValues(record, action)
            }
            else
            {
            }
            this.current_tab='form'
        },

        showForm(action, record) {
            /**
             * resetez erorile in Form Manager
             */
            this.formManager.errors = null

            /**
             * setez actiunea si recordul in Action Manager
             */
            this.am.setAction(action).setRecord(record)

            /**
             * setez valorile controalelor pe baza inregistrarii ce se vrea update|delete
             */
            if( (action == 'update') || (action == 'delete') )
            {
                this.setRecordValues(record, action)
            }
            else
            {
                this.current_tab='form'
            }           
        },

        init()
        {
            /**
             * Instantiez dt = Datatable Manager
             */
            this.dt = new AppCore.DatatableManager('grid-' + this.id, this.model, this)

            /**
             * Instantiez am = Actions Manager (insert | update | delete)
             */
            this.am = new AppCore.ActionsManager('action-' + this.id, this.model, this)

            /**
             * Populez gridul
             * - vad daca in model am criterii de filtrare
             * - daca am "per_page"
             */
            _.each(this.model.filter_by_fields, (filter, field) => this.dt.addFilter(field, filter) )
            this.dt.setDefaultOrder().changePageLength(this.model.per_page)
            
            /**
             * Daca s-a memorat pagina curenta in store
             */
            if( this.stored_grid )
            {
                this.dt.changePage(this.stored_grid.current_page)
            }
        
            /**
             * Preiau din Action Box (children[1]) Form manager si Record
             */
            let i = setInterval( () => {
                if(this.$children.length == 2)
                {
                    if( this.$children[1].formManager && this.$children[1].record)
                    {
                        clearInterval(i)
                        this.formManager = this.$children[1].formManager
                        this.record = this.$children[1].record
                        // console.log('Page::init()');
                        // console.log('Sunt in: ' + this.$options._componentTag + ' (' + this.$options.__file  + ')')
                        // console.log('Childern[1]: ' + this.$children[1].$options._componentTag + ' (' + this.$children[1].$options.__file  + ')')
                    }
                }
            }, 100)
        }
    },
}