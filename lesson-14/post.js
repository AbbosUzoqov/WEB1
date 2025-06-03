import { Post } from './src/components/post.js'

const renderPostItem = item => `
    <h2>
        User ID: ${item.userId}
    </h2>
    <h2>
        Post ID: ${item.id}
    </h2>
    <h2>
        Post title: ${item.title}
    </h2>
    <h2>
        Post body: ${item.body}
    </h2>
`

const renderCommentItem = item => `
    <div
        class="comment"
    >
        <hr>
        <h3>
            (Comment ID: ${item.id}) <br> ${item.name}
        </h3>
        <h3>
            E-mail: ${item.email}
        </h3>
        <p>
            Body: ${item.body}
        </p>
    </div>
`

const getPostItem = async (postId) => {
    return await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}`)
        .then(async res => {
            return res.json()
        }).catch(e => console.log("Error:", e));
}

const getCommentItems = async (postId) => {
    return await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}/comments`)
        .then(async res => {
            return res.json()
        }).catch(e => console.log("Error:", e));
}

const init = () => {
    const postEl = document.getElementById('post');
    const commentsEl = document.getElementById('comments');
    new Post(postEl, commentsEl,
        {
            getPost: getPostItem,
            getComments: getCommentItems,
            renderPost: renderPostItem,
            renderComment: renderCommentItem
        }).init()
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}