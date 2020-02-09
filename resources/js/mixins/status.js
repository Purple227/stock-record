

export default {

	data() {

		return{
			status: 'null',
		}
	},

	watch: {
		status() {
			setTimeout(() => {
				this.status = null
			}, 8000)
		}
	}

}
