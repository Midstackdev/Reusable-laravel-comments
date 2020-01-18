<template>
	<div>
		<h3 class="mb-5">Reply to comment</h3>

		<comment
			:comment="comment"
			:links="false"
		></comment>

		<form @submit.prevent="store" id="reply">
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
				<a href="" class="btn btn-link" @click.prevent="cancel">Cancel</a>
			</div>
		</form>
	</div>
</template>

<script>
	import Comment from './Comment'
	import bus from '../../bus'
	import axios from 'axios'
	import VueScrollTo from 'vue-scrollto'
	
	export default {
		data () {
			return {
				form: {
					body: null
				}
			}
		},

		props: {
			comment: {
				required: true,
				type: Object,
			}
		},

		components: {
			Comment
		},

		methods: {
			async store () {
				let reply = await axios.post(`/comments/${this.comment.id}/replies`, this.form)

				bus.$emit('comment:replied', {
					comment: this.comment,
					reply: reply.data.data
				})

				this.cancel()
			},

			cancel () {
				bus.$emit('comment:reply-cancelled')
			}
		},

		mounted () {
			VueScrollTo.scrollTo('#reply', 500)
		}
	}
</script>