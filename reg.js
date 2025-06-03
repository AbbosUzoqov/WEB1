const form = document.getElementById('reg-form');
const errorMessage = document.getElementById('error-message');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  errorMessage.style.display = 'none';
  errorMessage.textContent = '';

  const formData = new FormData(form);
  const email = formData.get('email');
  const name = formData.get('name');
  const age = Number(formData.get('age'));
  const password = formData.get('password');
  const passwordRepeat = formData.get('passwordRepeat');

  if (password !== passwordRepeat) {
    errorMessage.textContent = 'Пароли не совпадают';
    errorMessage.style.display = 'block';
    return;
  }

  try {
    const res = await fetch('http://localhost:3000/register', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, name, age, password }),
    });

    if (!res.ok) {
      const error = await res.json();
      throw new Error(error.message || 'Ошибка при регистрации');
    }

    alert('Регистрация успешна! Теперь войдите.');
    window.location.href = 'login.html';
  } catch (err) {
    errorMessage.textContent = err.message;
    errorMessage.style.display = 'block';
  }
});
