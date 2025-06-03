const token = localStorage.getItem('token');
if (!token) {
  window.location.href = 'login.html';
}

const todoList = document.getElementById('todo-list');
const todoForm = document.getElementById('todo-form');
const errorMessage = document.getElementById('error-message');

async function fetchTodos() {
  errorMessage.style.display = 'none';
  try {
    const res = await fetch('http://localhost:3000/todos', {
      headers: { Authorization: `Bearer ${token}` },
    });

    if (!res.ok) {
      throw new Error('Не удалось загрузить список дел');
    }

    const todos = await res.json();
    renderTodos(todos);
  } catch (err) {
    errorMessage.textContent = err.message;
    errorMessage.style.display = 'block';
  }
}

function renderTodos(todos) {
  todoList.innerHTML = '';
  todos.forEach(todo => {
    const li = document.createElement('li');
    li.dataset.id = todo.id;

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.checked = todo.completed;

    checkbox.addEventListener('click', async (e) => {
      e.preventDefault(); 

      try {
        const res = await fetch(`http://localhost:3000/todos/${todo.id}`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${token}`,
          },
          body: JSON.stringify({ completed: !todo.completed }),
        });

        if (!res.ok) throw new Error('Ошибка при обновлении статуса');

        todo.completed = !todo.completed;
        checkbox.checked = todo.completed;
      } catch (err) {
        alert(err.message);
      }
    });

    const titleSpan = document.createElement('span');
    titleSpan.textContent = todo.title;
    titleSpan.style.marginLeft = '8px';

    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Удалить';
    deleteBtn.style.marginLeft = '15px';

    deleteBtn.addEventListener('click', async () => {
      if (!confirm('Удалить дело?')) return;

      try {
        const res = await fetch(`http://localhost:3000/todos/${todo.id}`, {
          method: 'DELETE',
          headers: { Authorization: `Bearer ${token}` },
        });

        if (!res.ok) throw new Error('Ошибка при удалении');

        li.remove();
      } catch (err) {
        alert(err.message);
      }
    });

    li.appendChild(checkbox);
    li.appendChild(titleSpan);
    li.appendChild(deleteBtn);
    todoList.appendChild(li);
  });
}

todoForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  errorMessage.style.display = 'none';
  errorMessage.textContent = '';

  const formData = new FormData(todoForm);
  const title = formData.get('title').trim();
  if (!title) return;

  try {
    const res = await fetch('http://localhost:3000/todos', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ title }),
    });

    if (!res.ok) throw new Error('Ошибка при добавлении дела');

    const newTodo = await res.json();
    renderTodos([...todoList.querySelectorAll('li')].map(li => ({
      id: li.dataset.id,
      title: li.querySelector('span').textContent,
      completed: li.querySelector('input[type=checkbox]').checked,
    })).concat(newTodo));
    todoForm.reset();
  } catch (err) {
    errorMessage.textContent = err.message;
    errorMessage.style.display = 'block';
  }
});

fetchTodos();
