module.exports = {

    setConfig: ({ commit }) => commit('setConfig'),

    getFarm: ({ commit }, id) => commit('getCompany', id),
    setFarm: ({ commit }, farm) => commit('setCompany', farm),
}
