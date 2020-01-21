<template>
	<div>
		<form @submit.prevent="patch">
			<div class="form-group">
				<textarea 
				autofocus="autofocus" 
				id="body" 
				class="form-control" 
				:rows="textareaHeight"
				v-model="form.body"
				></textarea>
				<p class="form-text text-muted">Markdown and code highlighting are supported.</p>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Edit</button>
				<a href="" class="btn btn-link" @click.prevent="cancel">Cancel</a>
			</div>
		</form>
	</div>
</template>

<script>
	import bus from '../../bus'
	import axios from 'axios'

	export default {
		data () {
			return {
				form: {
					body: this.comment.body
				}
			}
		},

		computed: {
			textareaHeight () {
				return Math.max(Math.floor(this.comment.body.split(/\r*\n/).length / 2), 6)
			}
		},

		props: {
			comment: {
				required: true,
				type: Object
			}
		},

		methods: {
			async patch () {
				let comment = await axios.patch(`/comments/${this.comment.id}`, this.form)

				bus.$emit('comment:edited', comment.data.data)

				this.cancel()
			},

			cancel () {
				bus.$emit('comment:edit-cancelled', this.comment)
			}
		}

	}
</script>