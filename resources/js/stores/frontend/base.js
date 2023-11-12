import { defineStore } from "pinia";

export const useBaseStore = defineStore("base", {
    state: () => {
        return {
            baseData: [],
        }
    },
    actions: {
        async fetchBase(page, data) {
            setTimeout(() => {
                const bScript = document.createElement('script')
                bScript.type = 'text/javascript'
                bScript.src = 'js/bootstrap.bundle.min.js'
                document.body.appendChild(bScript)
             }, 500);
            setTimeout(() => {
                const cScript = document.createElement('script')
                cScript.type = 'text/javascript'
                cScript.src = 'js/plugins.min.js'
                document.body.appendChild(cScript)
             }, 1000);
            setTimeout(() => {
                const dScript = document.createElement('script')
                dScript.type = 'text/javascript'
                dScript.src = 'js/designesia.js'
                document.body.appendChild(dScript)
             }, 1500);
        },
    }
})