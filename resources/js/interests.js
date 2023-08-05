const interests = document.querySelectorAll('.interest');
const showCoursesBtn = document.getElementById('showCoursesBtn');

let selectedInterests = [];
interests.forEach(interest => {
    interest.addEventListener('click', function () {
        const interestId = this.getAttribute('data-id');

        if (selectedInterests.includes(interestId)) {
            selectedInterests = selectedInterests.filter(id => id !== interestId);
            this.classList.remove('selected');
        } else {
            selectedInterests.push(interestId);
            this.classList.add('selected');
        }
    });
});

showCoursesBtn.addEventListener('click', function () {
    console.log('Selected Interests to Send:', selectedInterests); // Debug log
    const url = filteredCoursesRoute + '?' + selectedInterests.map(id => 'interests[]=' + id).join('&');
    window.location.href = url;
});

