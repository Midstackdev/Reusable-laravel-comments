<template>
	<div>
		<h3 class="mb-5">{{ meta.total }} comments</h3>
		<new-comment 
			:endpoint="endpoint"
		>	
		</new-comment>
		<template v-if="comments.length">
			<ul class="list-unstyled">
				<comment
				v-for="comment in comments" 
				:key="comment.id"
				:comment="comment"
				></comment>
			</ul>
		</template>
		<p v-else class="mt-4">No comments to display</p>
		<a href="#"
			class="btn btn-light btn-block" 
			@click.prevent="loadMore"
			v-if="meta.current_page < meta.last_page"
		>Show more</a>
	</div>
</template>

<script>
	import NewComment from './NewComment'
	import Comment from './Comment'
	import bus from '../../bus'
	import axios from 'axios'

	export default {
		data () {
			return {
				comments: [],
				meta: {},
			}
		},

		props: {
			endpoint: {
				required: true,
				type: String,
			}
		},

		computed: {

		},

		components: {
			NewComment,
			Comment,
		},

		methods: {
			async loadComments(page = 1) {
				let comments = await axios.get(`${this.endpoint}?page=${page}`)

				this.comments = comments.data.data
				this.meta = comments.data.meta
			},

			async fetchMeta() {
				let comments = await axios.get(`${this.endpoint}?page=${this.meta.current_page}`)

				this.meta = comments.data.meta
			},

			async loadMore(page = 1) {
				let comments = await axios.get(`${this.endpoint}?page=${this.meta.current_page + 1}`)

				this.comments.push(...comments.data.data)
				this.meta = comments.data.meta
			},

			async prependComment (comment) {
				this.comments.unshift(comment)

				await this.fetchMeta()

				if (this.meta.current_page < this.meta.last_page) {
					this.comments.pop()
				}
			},
		},

		mounted () {
			this.loadComments(1)
			bus.$on('comment:stored', this.prependComment)
		}
	}
</script>