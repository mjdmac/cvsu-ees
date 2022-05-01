export default {
    data() {
        return {
            selected: [],
            selectedItem: false,
            roles: ["personnel", "admin"],
            perpages: [1, 5, 10, 25, 50, 100],
            options: [
                {
                    option: "",
                    is_correct: false,
                    img_path: "",
                },
                {
                    option: "",
                    is_correct: false,
                    img_path: "",
                },
                {
                    option: "",
                    is_correct: false,
                    img_path: "",
                },
                {
                    option: "",
                    is_correct: false,
                    img_path: "",
                },
            ],
            status: ["active", "inactive"],
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

        getPerPage: function () {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get("perpages");
        },

        getStatus: function () {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get("status");
        },

        changeStatusColor: function (status) {
            if (status == "personnel" || status == "applicant") {
                this.statusColor = "text-blue-500";
            } else if (status == "admin") {
                this.statusColor = "text-green-500";
            }
            return this.statusColor;
        },
    },
};
