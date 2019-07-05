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
        },
        isRedTime(due_time){
            let red_time = new Date(due_time) - Date.now();
            red_time = Math.ceil(red_time / (1000 * 3600 * 24));
            if(due_time !== null && red_time < 7){
                return true;
            }
            return false;
        },
    },
    computed: {
        dateFormat() {
            return this.isCurrentDate(this.due_time) ? "d MMM" : "d MMM, yyyy";
        }
    }
};
