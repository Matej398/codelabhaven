const express = require('express');
const exphbs = require('express-handlebars');
const path = require('path');
const session = require('express-session');
const rateLimit = require('express-rate-limit');
require('dotenv').config({ path: path.join(__dirname, '../.env') });

const homeRouter = require('./routes/home');
const aboutRouter = require('./routes/about');
const projectsRouter = require('./routes/projects');

const app = express();

// Setup Handlebars with custom helper
const hbs = exphbs.create({
    extname: '.hbs',
    defaultLayout: false,
    helpers: {
        toLowerCase: function(str) {
            return str.toLowerCase().replace(/\s+/g, '-');
        }
    }
});
app.engine('hbs', hbs.engine);
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

// Serve static files (CSS, images, screenshots)
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.static(path.join(__dirname, 'screenshots')));

// Session middleware
app.use(session({
    secret: 'super-secret-key',
    resave: false,
    saveUninitialized: false,
    cookie: { maxAge: 24 * 60 * 60 * 1000 }
}));

// Rate limit for routes (if needed, adjust for specific routes)
const limiter = rateLimit({
    windowMs: 15 * 60 * 1000, // 15 minutes
    max: 100 // Limit each IP to 100 requests per windowMs
});
app.use(limiter);

// Use routes
app.use('/', homeRouter);
app.use('/about', aboutRouter);
app.use('/projects', projectsRouter);

// Start server
const PORT = 3001;
app.listen(PORT, () => {
    console.log(`CodeLabHaven server running on port ${PORT}`);
});