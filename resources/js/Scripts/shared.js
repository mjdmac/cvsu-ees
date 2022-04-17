export default {
    data() {
        return {
            selected: [],
            selectedItem: false,
            roles: ["personnel", "admin"],
            nrows: [1, 10, 25, 50, 100]
        };
    },
    methods: {
        selectItem: function (item) {
            this.selectedItem = item;
        },
        unSelectItem: function (item) {
            this.selectedItem = false;
        },

        getRoles: function () {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get("roles");
        },

        getNRows: function () {
            let urlParams = new URLSearchParams(window.location.nrow);
            return urlParams.get("nrows");
        },

        changeStatusColor: function (status) {
            if (status == "personnel") {
                this.statusColor = "text-blue-500";
            } else if (status == "admin") {
                this.statusColor = "text-green-500";
            } 
            return this.statusColor;
        },
    },
};
