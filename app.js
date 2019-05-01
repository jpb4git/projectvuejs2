let vm = new Vue({
    el: "#app",

    data: {
        message: "message 1 ",
        url: "http://jpb.worldtravelfood.fr",
        success: true,
        persons: ['moi', 'toi', 'nous', 'vous', 'ils']
    },

    methods: {
        close: function () {
            // this reference data.
            this.success = false;
        },
    }
});
new Vue({
    el: '#MyId',
    data: {
        message: "Un autre message",   
    }
})

new Vue({

    el: '#MyId2',

    data: {
        inputMessage: 'message',
        message: "message",
        success: true,
    },

    methods: {
        updateH2: function () {
            console.log(this.inputMessage)
            this.message = this.inputMessage;
            console.log(this.message);
        }
    },

})
new Vue({
    el: '#MyId3',
    data: {
        success: true,
    },
    methods: {
        cls: function () {
            return this.success === true ? 'bg-success text-light' : 'bg-danger text-light';
        }
    },   
})

new Vue({

    el: '#MyId4',

    data: {
        success: false,
    },

   
    
})