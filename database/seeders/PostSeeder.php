<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = \App\Models\User::where('email', 'admin@example.com')->first();
        $editorUser = \App\Models\User::where('email', 'editor@example.com')->first();
        
        $categories = \App\Models\Category::all();
        
        $posts = [
            [
                'title' => 'Welcome to Laravel CMS',
                'slug' => 'welcome-to-laravel-cms',
                'excerpt' => 'Learn about our new content management system built with Laravel and Tailwind CSS.',
                'content' => 'This is a comprehensive content management system built with Laravel and Tailwind CSS. It provides a modern, responsive interface for managing your website content.

Key features include:
- User management with roles and permissions
- Content management for posts and pages
- Media library for file uploads
- Category management
- Responsive design with Tailwind CSS
- Modern admin dashboard

The system is designed to be easy to use while providing powerful features for content creators and administrators.',
                'status' => 'published',
                'featured' => true,
                'user_id' => $adminUser->id,
                'category_id' => $categories->where('slug', 'technology')->first()->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Getting Started with Content Creation',
                'slug' => 'getting-started-with-content-creation',
                'excerpt' => 'A beginner\'s guide to creating and managing content in our CMS.',
                'content' => 'Creating content in our CMS is straightforward and intuitive. Here\'s how to get started:

1. **Creating Posts**: Navigate to the Posts section in the admin panel and click "Create New Post". Fill in the title, content, and select a category.

2. **Adding Images**: Use the media library to upload and manage images. You can easily insert them into your posts.

3. **Categories**: Organize your content with categories. Create categories that make sense for your content structure.

4. **Publishing**: Set your content status to "Published" when you\'re ready to make it live on your website.

5. **SEO**: Add excerpts and meta descriptions to improve your content\'s search engine visibility.',
                'status' => 'published',
                'featured' => true,
                'user_id' => $editorUser->id,
                'category_id' => $categories->where('slug', 'business')->first()->id,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Best Practices for Web Content',
                'slug' => 'best-practices-for-web-content',
                'excerpt' => 'Tips and strategies for creating engaging and effective web content.',
                'content' => 'Creating effective web content requires understanding your audience and following best practices:

**Content Strategy**
- Know your target audience
- Create content that provides value
- Maintain consistency in tone and style
- Plan your content calendar

**Writing Tips**
- Use clear, concise language
- Break up text with headings and bullet points
- Include calls-to-action
- Proofread and edit thoroughly

**Visual Elements**
- Use high-quality images
- Maintain consistent branding
- Optimize images for web performance
- Include alt text for accessibility

**SEO Considerations**
- Research and use relevant keywords
- Write compelling meta descriptions
- Use descriptive headings
- Link to relevant internal content',
                'status' => 'published',
                'featured' => false,
                'user_id' => $adminUser->id,
                'category_id' => $categories->where('slug', 'lifestyle')->first()->id,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'The Future of Content Management',
                'slug' => 'future-of-content-management',
                'excerpt' => 'Exploring emerging trends and technologies in content management systems.',
                'content' => 'Content management systems are evolving rapidly, with new technologies and approaches emerging:

**Headless CMS**
Headless CMS solutions separate content management from presentation, offering more flexibility for developers and content creators.

**AI Integration**
Artificial intelligence is being integrated into CMS platforms to help with content optimization, automated tagging, and personalized content delivery.

**Mobile-First Design**
With mobile traffic surpassing desktop, CMS platforms are prioritizing mobile-first design and responsive content management.

**Real-Time Collaboration**
Modern CMS platforms are incorporating real-time collaboration features, allowing multiple users to work on content simultaneously.

**API-First Architecture**
API-first CMS platforms provide better integration capabilities with other systems and services.',
                'status' => 'published',
                'featured' => false,
                'user_id' => $editorUser->id,
                'category_id' => $categories->where('slug', 'technology')->first()->id,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Building a Successful Blog',
                'slug' => 'building-a-successful-blog',
                'excerpt' => 'Essential strategies for growing your blog and building an engaged audience.',
                'content' => 'Building a successful blog requires dedication, strategy, and consistent effort:

**Content Planning**
- Develop a content calendar
- Research trending topics in your niche
- Create pillar content that provides comprehensive value
- Plan for seasonal and trending content

**Engagement Strategies**
- Respond to comments promptly
- Encourage discussion with questions
- Share behind-the-scenes content
- Create interactive content like polls and quizzes

**Promotion and Distribution**
- Share on social media platforms
- Build an email list
- Collaborate with other bloggers
- Use SEO best practices

**Analytics and Improvement**
- Track key metrics like page views and engagement
- Analyze which content performs best
- Continuously improve based on data
- A/B test different approaches',
                'status' => 'published',
                'featured' => false,
                'user_id' => $adminUser->id,
                'category_id' => $categories->where('slug', 'business')->first()->id,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Health and Wellness in the Digital Age',
                'slug' => 'health-wellness-digital-age',
                'excerpt' => 'Maintaining physical and mental health while working in the digital world.',
                'content' => 'The digital age has brought many benefits, but it also presents unique challenges for our health and wellness:

**Physical Health**
- Take regular breaks from screens
- Practice proper ergonomics
- Stay active throughout the day
- Maintain good posture

**Mental Health**
- Set boundaries with technology
- Practice mindfulness and meditation
- Take time for offline activities
- Connect with others in person

**Digital Wellness**
- Use apps to track and improve habits
- Limit social media consumption
- Create tech-free zones in your home
- Practice digital minimalism

**Work-Life Balance**
- Set clear work boundaries
- Take regular vacations
- Prioritize sleep and rest
- Find hobbies outside of technology',
                'status' => 'published',
                'featured' => false,
                'user_id' => $editorUser->id,
                'category_id' => $categories->where('slug', 'health')->first()->id,
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }
    }
}
