<template>
	<div>
		<li class="media mt-4 mb-4" :id="`comment-${comment.id}`">
		    <img class="mr-3" :src="comment.user.avatar" alt="Generic placeholder image">
		    <div class="media-body">
		      <h5 class="mt-0 mb-1"><strong>{{ comment.user.name  }}</strong> 
		      	<template v-if="comment.child">
		      		<small> replied </small>
		      	</template>
		      	<small>
		      		{{ comment.created_at }}
		      		<span v-if="comment.edited" :title="comment.edited">(edited)</span>
		      	</small>
		      </h5>

		      <template v-if="editing">
		      	<comment-edit :comment="comment"></comment-edit>
		      </template>	
		      <template v-else>
			      <p class="mb-2">
			      	{{ comment.body }}
			      </p>
		      </template>

		      <ul class="list-inline" v-if="user.authenticated && !editing">
		      	<li class="list-inline-item" v-if="!comment.child">
		      		<a href="#"
		      			@click.prevent="reply"

		      		>Reply</a>
		      	</li>
		      	<li class="list-inline-item" v-if="comment.owner">
		      		<a href="#"
		      			@click.prevent="editing = true"

		      		>Edit</a>
		      	</li>
		      </ul>

		      <template v-if="comment.children">
		      	<ul class="list-unstyled">
		      		<comment
		      		v-for="child in comment.children"
		      		:key="child.id"
		      		:comment="child"
		      		></comment>
		      	</ul>
		      </template>
		    </div>

		  </li>
	</div>
</template>

<script>
	import Comment from './Comment'
	import CommentEdit from './CommentEdit'
	import bus from '../../bus'

	export default {
		name: "comment",
		data () {
			return {
				editing: false
			}
		},

		props: {
			links: {
				defualt: true,
				type: Boolean
			},
			comment: {
				required: true,
				type: Object
			}
		},

		components: {
			Comment,
			CommentEdit,
		},

		methods: {
			reply () {
				bus.$emit('comment:reply', this.comment)
			}
		},

		mounted () {
			bus.$on('comment:edit-cancelled', (comment) => {
				if (comment.id === this.comment.id) {
					this.editing = false
				}
			})
		}
	}
</script>