

export default {

	data() {

		return{
			status: 'null',
		}
	},

	watch: {
		status(val) {
			this.status = val
			setTimeout(() => {
				this.status = null
			}, 8000)
		}
	}

}
