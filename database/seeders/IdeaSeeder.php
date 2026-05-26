<?php

namespace Database\Seeders;

use App\Models\Idea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ideas')->insert([
            $idea1=[
                'investee_id' => 27,
                'name' => 'Innovative Tech Solutions',
                'slug' => 'innovative-tech-solutions',
                'short_description' => 'Revolutionary technology solutions for everyday problems.',
                'long_description' => 'We are on a mission to revolutionize various industries through our cutting-edge technology solutions. Our team is dedicated to addressing common challenges and providing innovative and efficient solutions. With a focus on pushing the boundaries of what\'s possible, we aim to create positive impacts and drive positive change.',
                'video_link' => 'https://www.youtube.com/embed/78iLznY0ae4',
                'required_investment_amount' => '50000',
                'estimated_return' => '70000',
                'return_on_investment' => '40.00',
                'team_size' => 'Less than 5',
                'has_multiple_investor' => false,
                'status' => 'open',
            ],
            $idea2=[
                'investee_id' => 17,
                'name' => 'Green Energy Innovations',
                'slug' => 'green-energy-innovations',
                'short_description' => 'Sustainable energy solutions for a greener future.',
                'long_description' => 'At Green Energy Innovations, we are committed to developing and implementing sustainable energy solutions that contribute to a greener and more environmentally friendly future. Our team is passionate about combating climate change through the creation and implementation of innovative technologies in the field of renewable energy. Join us in our mission to make a positive impact on the planet.',
                'video_link' => 'https://www.youtube.com/embed/b8Fbs57WhlM',
                'required_investment_amount' => '60000',
                'estimated_return' => '80000',
                'return_on_investment' => '33.33',
                'team_size' => '5 to 10',
                'has_multiple_investor' => true,
                'status' => 'open',
            ],
            $idea3=[
                'investee_id' => 29,
                'name' => 'HealthTech Innovators',
                'slug' => 'healthtech-innovators',
                'short_description' => 'Revolutionizing healthcare through technology.',
                'long_description' => 'HealthTech Innovators is dedicated to leveraging technology to revolutionize the healthcare industry. Our goal is to enhance patient care, improve medical diagnostics, and streamline healthcare processes. Join us in making a significant impact on the health and well-being of individuals around the world.',
                'video_link' => 'https://www.youtube.com/embed/jMBExTJRcVw',
                'required_investment_amount' => '75000',
                'estimated_return' => '100000',
                'return_on_investment' => '33.33',
                'team_size' => '5 to 10',
                'has_multiple_investor' => true,
                'status' => 'open',
            ],
            $idea4=[
                'investee_id' => 14,
                'name' => 'Eco-friendly Packaging Solutions',
                'slug' => 'eco-friendly-packaging-solutions',
                'short_description' => 'Innovative packaging for a sustainable future.',
                'long_description' => 'Our company is committed to providing eco-friendly packaging solutions to reduce the environmental impact of traditional packaging materials. We believe in the importance of sustainable practices in the packaging industry and aim to create products that are both environmentally friendly and effective. Join us in our mission to make packaging greener.',
                'video_link' => 'https://www.youtube.com/embed/7IDRRklol8Q',
                'required_investment_amount' => '45000',
                'estimated_return' => '60000',
                'return_on_investment' => '33.33',
                'team_size' => 'Less than 5',
                'has_multiple_investor' => false,
                'status' => 'open',
            ],
            $idea5=[
                'investee_id' => 12,
                'name' => 'EdTech Solutions for Remote Learning',
                'slug' => 'edtech-remote-learning',
                'short_description' => 'Empowering education through technology.',
                'long_description' => 'In the era of remote learning, our EdTech company is dedicated to providing innovative solutions to empower educators and students alike. We develop cutting-edge tools and platforms to enhance the online learning experience. Join us in shaping the future of education through technology.',
                'video_link' => 'https://www.youtube.com/embed/UnGHwkoe764',
                'required_investment_amount' => '80000',
                'estimated_return' => '120000',
                'return_on_investment' => '50.00',
                'team_size' => '5 to 10',
                'has_multiple_investor' => true,
                'status' => 'open',
            ],
            $idea6=[
                'investee_id' => 30,
                'name' => 'Smart Agriculture Solutions',
                'slug' => 'smart-agriculture-solutions',
                'short_description' => 'Harnessing technology for sustainable farming.',
                'long_description' => 'Our company focuses on leveraging smart technologies to revolutionize agriculture. We aim to improve efficiency, reduce environmental impact, and increase yields through the implementation of innovative solutions. Join us in shaping the future of sustainable and smart agriculture.',
                'video_link' => 'https://www.youtube.com/embed/LS3XGUZzLuI',
                'required_investment_amount' => '60000',
                'estimated_return' => '90000',
                'return_on_investment' => '50.00',
                'team_size' => 'Less than 5',
                'has_multiple_investor' => false,
                'status' => 'open',
            ],
            $idea7=[
                'investee_id' => 19,
                'name' => 'AI-driven Financial Analytics',
                'slug' => 'ai-financial-analytics',
                'short_description' => 'Transforming financial decision-making with artificial intelligence.',
                'long_description' => 'Our company specializes in providing AI-driven financial analytics solutions to empower businesses in making informed and strategic financial decisions. We leverage the power of artificial intelligence to analyze data, identify trends, and provide actionable insights. Join us in shaping the future of financial analytics.',
                'video_link' => 'https://www.youtube.com/embed/LR1aOl7Z2wk',
                'required_investment_amount' => '90000',
                'estimated_return' => '130000',
                'return_on_investment' => '44.44',
                'team_size' => '5 to 10',
                'has_multiple_investor' => true,
                'status' => 'open',
            ],
        ]);

        $idea1 = Idea::find(1)->sectors()->sync([1, 6]);
        $idea2 = Idea::find(2)->sectors()->sync([5, 4, 11]);
        $idea3 = Idea::find(3)->sectors()->sync([3, 11, 1]);
        $idea4 = Idea::find(4)->sectors()->sync([5, 4, 10]);
        $idea5 = Idea::find(5)->sectors()->sync([1, 2]);
        $idea6 = Idea::find(6)->sectors()->sync([4, 5, 11]);
        $idea7 = Idea::find(7)->sectors()->sync([1]);

    }
}
