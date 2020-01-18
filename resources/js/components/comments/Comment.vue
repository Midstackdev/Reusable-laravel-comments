<template>
	<div>
		<li class="media mt-4 mb-4">
		    <img class="mr-3" :src="comment.user.avatar" alt="Generic placeholder image">
		    <div class="media-body">
		      <h5 class="mt-0 mb-1"><strong>{{ comment.user.name  }}</strong> <small>{{ comment.created_at }}</small></h5>
		      {{ comment.body }}
		    </div>
		  </li>
	</div>
</template>

<script>
	
	export default {
		props: {
			comment: {
				required: true,
				type: Object
			}
		}
	}
</script>