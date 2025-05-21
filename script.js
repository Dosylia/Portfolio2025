// Tab switching
function switchTab(tabName) {
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
    document.querySelector(`.tab-button[onclick="switchTab('${tabName}')"]`).classList.add('active');
    document.getElementById(tabName).classList.add('active');
}

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const nav = document.querySelector('.glass-nav');
    if (window.scrollY > 100) {
        nav.style.backgroundColor = 'var(--nav-bg)';
    } else {
        nav.style.backgroundColor = 'transparent';
    }
});

document.addEventListener("DOMContentLoaded", function () {

    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('nav-links');

    burger.addEventListener('click', () => {
        navLinks.classList.toggle('show');
    });

    fetch('projects.json')
        .then(response => response.json())
        .then(projects => {
            const container = document.getElementById('projects-container');
            projects.forEach(project => {
                const projectHTML = `
                    <div class="project-card">
                        <img class="project-image" src="./images/projects/${project.picture[0]}" alt="${project.title}" loading="lazy">
                        <h3>${project.title}</h3>
                        <p>${project.description}</p>
                        <div class="project-technologies">
                            ${project.technologies.map(tech => `
                                <i class="${tech}"></i>
                            `).join('')}
                        </div>
                        <div class="project-links">
                            ${project.github ? `<a href="${project.github}" target="_blank"><i class="fab fa-github"></i> GitHub</a>` : ''}
                            ${project.hosting ? `<a href="${project.hosting}" target="_blank"><i class="fas fa-external-link-alt"></i> Live Demo</a>` : ''}
                        </div>
                    </div>
                `;
                container.innerHTML += projectHTML;
            });
        })

});
