<template>
	<div>
		<new-comment 
			:endpoint="endpoint"
		>	
		</new-comment>
	</div>
</template>

<script>
	import NewComment from './NewComment'
	import bus from '../../bus'

	export default {
		props: {
			endpoint: {
				required: true,
				type: String,
			}
		},

		components: {
			NewComment
		},

		methods: {
			prependComment (comment) {
				console.log(comment)
			}
		},

		mounted () {
			bus.$on('comment:stored', this.prependComment)
		}
	}
</script>