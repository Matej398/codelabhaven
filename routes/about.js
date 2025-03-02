const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
    res.render('about', {
        title: 'About CodeLabHaven',
        content: 'Welcome to CodeLabHaven, a showcase of my coding adventures! I’m Blecky398, a passionate developer building tools and projects to solve real-world problems. From SignEasy to future creations, this is my space to share what I’ve built and learned. Stay tuned for more!'
    });
});

module.exports = router;