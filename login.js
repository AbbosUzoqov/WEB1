const form = document.getElementById('login-form');
const errorMessage = document.getElementById('error-message');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  errorMessage.style.display = 'none';
  errorMessage.textContent = '';

  const formData = new FormData(form);
  const email = formData.get('email');
  const password = formData.get('password');

  try {
    const res = await fetch('http://localhost:3000/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password }),
    });

    if (!res.ok) {
      const error = await res.json();
      throw new Error(error.message || 'Ошибка при входе');
    }

    const data = await res.json();
    localStorage.setItem('token', data.token);
    window.location.href = 'todos.html';
  } catch (err) {
    errorMessage.textContent = err.message;
    errorMessage.style.display = 'block';
  }
});
