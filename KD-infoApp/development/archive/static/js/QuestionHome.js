const modal = document.getElementById('questionModal');
  const btn = document.getElementById('newQuestionBtn');
  const span = document.getElementsByClassName('close')[0];
  btn.onclick = function() {
    modal.style.display = 'flex';
  };
  span.onclick = function() {
    modal.style.display = 'none';
  };
  window.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  };

  document.getElementById('questionForm').onsubmit = function(event) {
    event.preventDefault();
    const title = document.getElementById('questionTitle').value;
    const body = document.getElementById('questionBody').value;
    const tags = document.getElementById('questionTags').value.split(',').map(tag => tag.trim()).filter(tag => tag !== '');

    const div = document.createElement('div');
    div.className = 'question';
    div.innerHTML = `
      <div class="question-title">${title}</div>
      <div class="question-meta">@user - Q&A - 回答数0 - <span class="question-date">2024年4月19日</span></div>
      <ul class="question-tags">
        ${tags.map(tag => `<li>${tag}</li>`).join('')}
      </ul>
    `;
    const questionList = document.getElementById('questionsList');
    questionList.insertBefore(div, questionList.firstChild);

    modal.style.display = 'none';
    document.getElementById('questionTitle').value = '';
    document.getElementById('questionBody').value = '';
    document.getElementById('questionTags').value = '';
  };