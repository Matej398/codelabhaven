const express = require('express');
const router = express.Router();
const fs = require('fs').promises;
const path = require('path');

router.get('/', async (req, res) => {
    try {
        const projects = JSON.parse(await fs.readFile(path.join(__dirname, '../projects.json'), 'utf8'));
        res.render('projects', {
            projectCount: projects.length,
            projects: projects
        });
    } catch (err) {
        console.error('Error loading projects:', err);
        res.status(500).send('Error loading projects page');
    }
});

module.exports = router;