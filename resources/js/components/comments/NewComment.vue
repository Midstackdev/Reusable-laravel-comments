<template>
	<div class="mb-5">
		<a 
		href="#"
		class="btn btn-primary btn-block" 
		@click.prevent="active = true"
		v-if="!active"
		>
			
		Post a comment</a>
		<template v-if="active">
			<form @submit.prevent="store">
				<div class="form-group">
					<textarea 
					autofocus="autofocus" 
					id="body" 
					class="form-control" 
					rows="10"
					v-model="form.body"
					></textarea>
					<p class="form-text text-muted">Markdown and code highlighting are supported.</p>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Post</button>
					<a href="" class="btn btn-link" @click.prevent="active = false">Cancel</a>
				</div>
			</form>
		</template>
	</div>
</template>

<script>
	import axios from 'axios'
	import bus from '../../bus'

	export default {
		data () {
			return {
				active: false,
				form: {
					body: null
				}
			}
		},

		props: {
			endpoint: {
				required: true,
				type: String,
			}
		},

		methods: {
			async store () {
				let comment = await axios.post(this.endpoint, this.form)

				bus.$emit('comment:stored', comment.data.data)

				this.active = false
				this.form.body = null
			}
		}
	}
</script>