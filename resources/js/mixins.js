export const taskMixins = {
    methods: {
        isCurrentDate(date) {
            let due_year = new Date(date).getFullYear();
            let now_year = new Date().getFullYear();

            return due_year == now_year;
        },
        successMsg(message) {
            this.$message({
                message: message,
                type: "success"
            });
        }
    },
    computed: {
        dateFormat() {
            return this.isCurrentDate(this.due_time) ? "d MMM" : "d MMM, yyyy";
        }
    }
};
