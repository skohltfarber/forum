<template>

    <AppLayout :title="post.title">
        <Container>
            <h1 class="text-2xl font-bold">{{ post.title }}</h1>
            <span class="block mt-1 text-sm text-grey-600">{{ formattedDate }} ago by {{ post.user.name }}</span>

            <article class="mt-6">
                <pre class="whitespace-pre-wrap font-sans">{{ post.body }}</pre>
            </article>

            <div class="mt-12">
                <h2 class="text-xl font-semibold">Comments</h2>
                <block>{{ props.comments.body }}</block>

                <ul class="divide-y mt-4"> 

                    <li v-for="comment in comments.data" :key="comment.id" class="px-2 py-4">
                        <Comment :comment="comment" />
                    </li>

                </ul>

                <Pagination :meta="comments.meta" :only="['comments']"/>
            </div>

        </Container>
    </AppLayout>

</template>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import Container from '@/Components/Container.vue';
import Comment from '@/Components/Comment.vue';
import { computed } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import { relativeDate } from '@/Utilities/date';

const props = defineProps(['post', 'comments']);
const formattedDate = computed(() => relativeDate(props.post.created_at));

</script>