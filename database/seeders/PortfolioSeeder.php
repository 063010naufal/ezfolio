<?php

namespace Database\Seeders;

use CoreConstants;
use App\Models\PortfolioConfig;
use App\Services\Contracts\AboutInterface;
use App\Services\Contracts\EducationInterface;
use App\Services\Contracts\PortfolioConfigInterface;
use App\Services\Contracts\SkillInterface;
use Illuminate\Database\Seeder;
use Log;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $portfolioConfig = resolve(PortfolioConfigInterface::class);
            $about = resolve(AboutInterface::class);
            $education = resolve(EducationInterface::class);
            $skill = resolve(SkillInterface::class);

            //portfolio config table seed

            //template
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__TEMPLATE,
                'setting_value' => 'procyon',
                'default_value' => 'procyon',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //accent color
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__ACCENT_COLOR,
                'setting_value' => '#0168fa',
                'default_value' => '#0168fa',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //google analytics ID
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__GOOGLE_ANALYTICS_ID,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //maintenance mode
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__MAINTENANCE_MODE,
                'setting_value' => CoreConstants::FALSE,
                'default_value' => CoreConstants::FALSE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            //visibility
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_ABOUT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SKILL,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_EDUCATION,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_EXPERIENCE,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_PROJECT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SERVICE,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_CONTACT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_FOOTER,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_CV,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SKILL_PROFICIENCY,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            //header script
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__SCRIPT_HEADER,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //footer script
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__SCRIPT_FOOTER,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);


            //meta title
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_TITLE,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta author
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_AUTHOR,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta description
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_DESCRIPTION,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta image
            try {
                if (is_dir('public/assets/common/img/meta-image')) {
                    $dir = 'public/assets/common/img/meta-image';
                } else {
                    $dir = 'assets/common/img/meta-image';
                }
                $leave_files = array('.gitkeep');
                
                foreach (glob("$dir/*") as $file) {
                    if (!in_array(basename($file), $leave_files)) {
                        unlink($file);
                    }
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_IMAGE,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);


            //about table seed
            try {
                try {
                    //avatar
                    if (is_dir('public/assets/common/img/avatar')) {
                        $dir = 'public/assets/common/img/avatar';
                    } else {
                        $dir = 'assets/common/img/avatar';
                    }
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }

                    if (is_dir('public/assets/common/img/avatar')) {
                        copy('public/assets/common/default/avatar/default.png', $dir.'/default.png');
                    } else {
                        copy('assets/common/default/avatar/default.png', $dir.'/default.png');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                try {
                    //cover
                    if (is_dir('public/assets/common/img/cover')) {
                        $dir = 'public/assets/common/img/cover';
                    } else {
                        $dir = 'assets/common/img/cover';
                    }
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }

                    if (is_dir('public/assets/common/img/cover')) {
                        copy('public/assets/common/default/cover/default.png', $dir.'/default.png');
                    } else {
                        copy('assets/common/default/cover/default.png', $dir.'/default.png');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                try {
                    //cv
                    if (is_dir('public/assets/common/cv')) {
                        $dir = 'public/assets/common/cv';
                    } else {
                        $dir = 'assets/common/cv';
                    }

                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }
                    if (is_dir('public/assets/common/default/cv/')) {
                        copy('public/assets/common/default/cv/default.pdf', $dir.'/default.pdf');
                    } else {
                        copy('assets/common/default/cv/default.pdf', $dir.'/default.pdf');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
                
                $data = [
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                    'avatar' => 'assets/common/img/avatar/default.png',
                    'cover' => 'assets/common/img/cover/default.png',
                    'phone' => '12025550191',
                    'address' => '1609 Nuzum Court, Cheektowaga, NY 14225',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non corporis assumenda maiores. Impedit quia necessitatibus adipisci sit quibusdam aspernatur mollitia, deleniti, id, molestiae a accusantium modi sint expedita aliquam labore.',
                    'taglines' => ["I am Software Engineer", "I am Web Developer", "I am Full Stack Engineer"],
                    'socialLinks' => [
                        [
                            'title' => 'LinkedIn',
                            'iconClass' => 'fab fa-linkedin-in',
                            'link' => 'https://www.linkedin.com'
                        ],
                        [
                            'title' => 'Github',
                            'iconClass' => 'fab fa-github',
                            'link' => 'https://github.com'
                        ],
                        [
                            'title' => 'Twitter',
                            'iconClass' => 'fab fa-twitter',
                            'link' => 'https://twitter.com'
                        ],
                        [
                            'title' => 'Mail',
                            'iconClass' => 'far fa-envelope',
                            'link' => 'mailto:johndoe@example.com'
                        ],
                    ],
                    'seederCV' => 'assets/common/cv/default.pdf',
                ];
                $about->store($data);

                //education table seed
                try {
                    $data = [
                        'institution' => 'University of Colorado Boulder',
                        'period' => '2006-2010',
                        'degree' => 'Bachelor of Science',
                        'cgpa'  => '4.00 out of 4.00',
                        'department' => 'Computer Science & Engineering',
                        'thesis' => 'Web Development Track'
                    ];
                    $education->store($data);

                    $data = [
                        'institution' => 'James Buchanan High School',
                        'period' => '2002-2006',
                        'degree' => 'Technology Magnet Program',
                        'cgpa' => '3.75 out of 4.00',
                        'department' => null,
                        'thesis' => null
                    ];
                    $education->store($data);
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //skill table seed
            try {
                $data = [
                    'name'    => 'Laravel',
                    'proficiency' => '100'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'PHP',
                    'proficiency' => '100'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'JavaScript',
                    'proficiency' => '95'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'React.js',
                    'proficiency' => '95'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'Vue.js',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'jQuery',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'MySQL',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'CSS',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name'    => 'Node.js',
                    'proficiency' => '80'
                ];
                $skill->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
