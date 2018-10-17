module.exports = {

    setConfig: ({ commit }) => commit('setConfig'),

    getFarm: ({ commit }, id) => commit('getFarm', id),
    setFarm: ({ commit }, farm) => commit('setFarm', farm),
}
