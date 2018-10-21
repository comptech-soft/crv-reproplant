const routes = {
    
    farms: require('./Farms/farms'),
    farm: require('./Farms/farm'),

    /**
     * Lista generala de tauri
     */
    animals: require('./Animals/animals'),

    /**
     * Valori de reproducere
     */
    breeding: require('./Animals/breeding'),

    /**
     * Dashboard animal
     */
    animal: require('./Animals/animal')
}

module.exports = routes