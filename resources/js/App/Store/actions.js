module.exports = {

    setConfig: ({ commit }) => commit('setConfig'),

    getFarm: ({ commit }, id) => commit('getFarm', id),
    setFarm: ({ commit }, farm) => commit('setFarm', farm),

    getAnimal: ({ commit }, id) => commit('getAnimal', id),
    setAnimal: ({ commit }, animal) => commit('setAnimal', animal),

    setAnimal: ({ commit }, animal) => commit('setAnimal', animal),

    saveCurrentPage: ({ commit }, page) => commit('saveCurrentPage', page),
    
}
