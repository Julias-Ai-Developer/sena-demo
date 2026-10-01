<?php

namespace Database\Seeders;

use App\Models\AcademicProgram;
use App\Models\AdmissionRequirement;
use App\Models\GalleryItem;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. SITE SETTINGS
        $settings = [
            // General / Header
            'school_name' => ['value' => 'SENA HIGH SCHOOL', 'group' => 'general', 'type' => 'text'],
            'school_tagline' => ['value' => 'Entebbe • Seek knowledge, serve humanity', 'group' => 'general', 'type' => 'text'],
            'school_motto' => ['value' => 'Seek knowledge, serve humanity', 'group' => 'general', 'type' => 'text'],
            'crest_url' => ['value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDGUnAR6QXR0-zZ44q-gmCSmncd26DxTatrmrUhWWrq1fr9qMKOg-7PIYhuDLSP1qQLg8peh_ckDnkFk3m4_xFpKTtKJo9p7GfhK2YcUxJvy4B3tVWEdfWfg5EFAjQ9JRTGYmapGfQzcUKSZmS88tghDRecTdbSmiax1y_LDITLuTn6RnFxXXzjNwztuwA2ZQLBxsUAoLFBzh36FTo3ypWxHzx_o5cSxekbau5p742pK_dJvfc0RDuZaw38prmZGiKGTw', 'group' => 'general', 'type' => 'image'],
            'announcement_badge' => ['value' => 'Admissions Open', 'group' => 'general', 'type' => 'text'],
            'announcement_text' => ['value' => 'Enrollment ongoing for Senior 1 & Senior 5 — Academic Year 2025', 'group' => 'general', 'type' => 'text'],
            'campus_location' => ['value' => 'Entebbe, Uganda', 'group' => 'general', 'type' => 'text'],
            'phone_primary' => ['value' => '+256 (0) 414 321 000', 'group' => 'contact', 'type' => 'text'],
            'phone_secondary' => ['value' => '+256 (0) 701 445 220', 'group' => 'contact', 'type' => 'text'],
            'email_primary' => ['value' => 'admissions@senahighentebbe.sc.ug', 'group' => 'contact', 'type' => 'text'],
            'address_full' => ['value' => 'Entebbe Municipality, Off Kampala-Entebbe Highway, Wakiso District, Uganda', 'group' => 'contact', 'type' => 'textarea'],
            'uneb_center_no' => ['value' => 'UNEB Centre No: U2488 / MoES Registered', 'group' => 'general', 'type' => 'text'],

            // Hero Section
            'hero_badge' => ['value' => 'Excellence in Secondary Education Since 2004', 'group' => 'hero', 'type' => 'text'],
            'hero_title_highlight' => ['value' => 'Intellectual Leaders', 'group' => 'hero', 'type' => 'text'],
            'hero_title_prefix' => ['value' => 'Nurturing', 'group' => 'hero', 'type' => 'text'],
            'hero_title_suffix' => ['value' => '& Moral Integrity in Entebbe', 'group' => 'hero', 'type' => 'text'],
            'hero_paragraph' => ['value' => 'Embracing our noble motto — "Seek knowledge, serve humanity". Sena High School offers world-class UNEB O-Level & A-Level education, modern STEM laboratories, arts, and vibrant lakeside campus life.', 'group' => 'hero', 'type' => 'textarea'],
            'hero_image' => ['value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBTBymSuR9XvA4AH1OVOVuQ66YTadBK-4iA4Q7mviYIPyu4N-yyr16oakW9Uquhpt-UOapFWlfNsf7PD0M3AA1A0yUqPr7OCUl9sol84x0z4MT8Z2xa6MKRLMwA2EJBoHbyK88Vb2yAF7Va4diO1MVUYaOqWtlQidEOqC0L4f2K9ShuyRgcHqwKoCEQysNQh52hK7nApHWna7I2VfLpg6Koz-VCoxI9HmYXC-SBF5vFzl3rLRMBZdq-', 'group' => 'hero', 'type' => 'image'],
            'hero_badge_corner' => ['value' => 'Top Academic Performer', 'group' => 'hero', 'type' => 'text'],
            'hero_card_title' => ['value' => 'Center of Scholarly Distinction', 'group' => 'hero', 'type' => 'text'],
            'hero_card_desc' => ['value' => 'Fully accredited by UNEB & Ministry of Education and Sports.', 'group' => 'hero', 'type' => 'text'],

            // Hero Stats
            'stat1_value' => ['value' => '100%', 'group' => 'stats', 'type' => 'text'],
            'stat1_label' => ['value' => 'Division 1 & 2 Pass Rate', 'group' => 'stats', 'type' => 'text'],
            'stat2_value' => ['value' => '25+', 'group' => 'stats', 'type' => 'text'],
            'stat2_label' => ['value' => 'Clubs, Arts & Sports', 'group' => 'stats', 'type' => 'text'],
            'stat3_value' => ['value' => '1 : 14', 'group' => 'stats', 'type' => 'text'],
            'stat3_label' => ['value' => 'Teacher-Student Ratio', 'group' => 'stats', 'type' => 'text'],
            'stat4_value' => ['value' => 'Eco-Campus', 'group' => 'stats', 'type' => 'text'],
            'stat4_label' => ['value' => 'Lakeside Environment', 'group' => 'stats', 'type' => 'text'],

            // Headmaster Section
            'headmaster_name' => ['value' => 'Mr. K. Ronald Musisi', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_title' => ['value' => 'Headteacher & Director of Studies, Sena High School', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_experience' => ['value' => '20+ Years Educational Leadership', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_qualifications' => ['value' => 'B.Ed (Hons), M.Ed Educ Admin', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_image' => ['value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD8mlabocA3NzF5sKDOxsB0skzQp2tWulni4XRit9p0PmPwL-BvvIIOkSzSkbQ4SbkuoD4W2yxIHZZZfL4wOSNob-8JZ5qlQHREP1_RkKgACSDn2-FDLjPww05lSEnPAQf9E_xLyWP57vCNWJ48V8Bi7nPh3MY7rpxJKkOTxcjXgb26cs9hN_KJezlF_D_hYYy96DwXsho4dJYk_nbzv12xMGVSwfnbFRrrkofnJEBlDMAWdKNbnD25', 'group' => 'headmaster', 'type' => 'image'],
            'headmaster_section_title' => ['value' => 'Building Foundations for Lifelong Knowledge, Leadership & Selfless Service', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_quote' => ['value' => 'At Sena High School Entebbe, our mission transcends academic excellence. We empower young men and women to discover their intellectual identity while grounding their character in empathy, fear of God, and unconditional service to society.', 'group' => 'headmaster', 'type' => 'textarea'],
            'headmaster_welcome_text' => ['value' => 'Nestled along the calm breezes of Entebbe, our campus provides a peaceful sanctuary away from city distractions. Here, students engage with state-of-the-art sciences, rich humanistic arts, and vibrant extracurricular pursuits governed by our guiding compass: Seek knowledge, serve humanity.', 'group' => 'headmaster', 'type' => 'textarea'],
            'headmaster_card1_title' => ['value' => 'Academic Rigor', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_card1_desc' => ['value' => 'Uncompromising UNEB syllabus mastery with individual student mentoring.', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_card2_title' => ['value' => 'Moral Integrity', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_card2_desc' => ['value' => 'Instilling ethical values, personal discipline, and respect for diversity.', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_card3_title' => ['value' => 'Humanity Service', 'group' => 'headmaster', 'type' => 'text'],
            'headmaster_card3_desc' => ['value' => 'Active community outreach, environmental stewardship, and civic empathy.', 'group' => 'headmaster', 'type' => 'text'],

            // Admissions & Scholarships
            'admissions_title' => ['value' => 'Start Your Journey at Sena High School', 'group' => 'admissions', 'type' => 'text'],
            'admissions_subtitle' => ['value' => 'We welcome applications from motivated boys and girls seeking academic excellence, moral grounding, and purposeful leadership.', 'group' => 'admissions', 'type' => 'textarea'],
            'admissions_s1_status' => ['value' => 'Ongoing', 'group' => 'admissions', 'type' => 'text'],
            'admissions_s5_status' => ['value' => 'Forms Available', 'group' => 'admissions', 'type' => 'text'],
            'admissions_transfer_status' => ['value' => 'Subject to Interview', 'group' => 'admissions', 'type' => 'text'],
            'admissions_bursary_title' => ['value' => 'Bursaries & Academic Merit Scholarships', 'group' => 'admissions', 'type' => 'text'],
            'admissions_bursary_desc' => ['value' => 'Special partial scholarships are awarded to students scoring Aggregate 4 to 6 in PLE and Division 1 (Aggregate 8–18 in UCE).', 'group' => 'admissions', 'type' => 'textarea'],
            'admissions_hotline' => ['value' => '+256 (0) 701 445 220 / +256 (0) 772 341 890', 'group' => 'admissions', 'type' => 'text'],
        ];

        foreach ($settings as $key => $data) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $data['value'],
                    'group' => $data['group'],
                    'type' => $data['type'],
                ]
            );
        }

        // 2. ACADEMIC PROGRAMS
        if (AcademicProgram::count() === 0) {
            $programs = [
                [
                    'tag' => 'UCE • Senior 1 - 4',
                    'title' => 'Lower Secondary Curriculum',
                    'description' => 'Competence-based curriculum focusing on practical problem solving, critical thinking, research projects, and broad foundational science and arts mastery.',
                    'features' => [
                        'Integrated Science & Maths',
                        'French, Kiswahili & English Lit',
                        'Performing Arts & Physical Educ',
                    ],
                    'link_label' => 'View UCE Subject Combinations',
                    'link_url' => '#admissions',
                    'icon' => 'auto_stories',
                    'accent_bar' => 'bg-primary',
                    'icon_bg' => 'bg-primary-fixed',
                    'icon_color' => 'text-primary',
                    'label_color' => 'text-primary',
                    'link_color' => 'text-primary group-hover:text-surface-tint',
                    'order_index' => 1,
                    'is_active' => true,
                ],
                [
                    'tag' => 'UACE • Senior 5 - 6',
                    'title' => 'Advanced STEM & Sciences',
                    'description' => 'Pioneering preparation for Medicine, Engineering, Computing, and Agri-technology with rigorous daily hands-on wet labs and digital simulation.',
                    'features' => [
                        'PCB / BCM (Medical & Biological)',
                        'PCM / PEM (Engineering Fields)',
                        'Sub-ICT & Applied Mathematics',
                    ],
                    'link_label' => 'Explore Science Laboratories',
                    'link_url' => '#admissions',
                    'icon' => 'biotech',
                    'accent_bar' => 'bg-secondary',
                    'icon_bg' => 'bg-secondary-fixed',
                    'icon_color' => 'text-secondary',
                    'label_color' => 'text-secondary',
                    'link_color' => 'text-secondary',
                    'order_index' => 2,
                    'is_active' => true,
                ],
                [
                    'tag' => 'UACE • Senior 5 - 6',
                    'title' => 'Humanities, Law & Commerce',
                    'description' => 'Cultivating eloquent advocates, future economists, diplomats, and business leaders through deep debate, constitutional law previews, and financial studies.',
                    'features' => [
                        'HEL / LEG (Law & Governance)',
                        'MEA / MEG (Economics & Finance)',
                        'History, Divinity & Fine Art',
                    ],
                    'link_label' => 'View Arts Syllabi',
                    'link_url' => '#admissions',
                    'icon' => 'account_balance',
                    'accent_bar' => 'bg-primary',
                    'icon_bg' => 'bg-primary-fixed',
                    'icon_color' => 'text-primary',
                    'label_color' => 'text-primary',
                    'link_color' => 'text-primary group-hover:text-surface-tint',
                    'order_index' => 3,
                    'is_active' => true,
                ],
                [
                    'tag' => 'Vocational & Tech',
                    'title' => 'ICT & Entrepreneurship Hub',
                    'description' => 'Equipping every student with tangible 21st-century competence: software coding, web basics, business model canvases, and public speaking mastery.',
                    'features' => [
                        'High-speed Gigabit Computing Lab',
                        'Junior Achievement Enterprise Club',
                        'Digital Literacy Certification',
                    ],
                    'link_label' => 'Inquire About Tech Hub',
                    'link_url' => '#admissions',
                    'icon' => 'developer_board',
                    'accent_bar' => 'bg-secondary',
                    'icon_bg' => 'bg-secondary-fixed',
                    'icon_color' => 'text-secondary',
                    'label_color' => 'text-secondary',
                    'link_color' => 'text-secondary',
                    'order_index' => 4,
                    'is_active' => true,
                ],
            ];

            foreach ($programs as $prog) {
                AcademicProgram::create($prog);
            }
        }

        // 3. GALLERY ITEMS
        if (GalleryItem::count() === 0) {
            $sportsUrl = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCqFCQKig6Dxf1uYqyhADEX-v6QlCH9C7ID2rELKHm4hrCZR5KKCMfZM0jMyvGnMuUia8g1E3_Vf864O8vqT38UQUpTBol5Z_KYUKXIebgHbY18BqUEb8ie5-zBanS_Mfl-FH_1mfkhrdujkPVjwZ-22QybGHf8suTtcjMbGOCLCYZQYYAhhTNN2C1uht_9GtZJtojdIN8xBbZKqMRV_Ee4eSjaWyov2rHdrQNkEz8cpkN9eidXicNK';
            $heroUrl = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBTBymSuR9XvA4AH1OVOVuQ66YTadBK-4iA4Q7mviYIPyu4N-yyr16oakW9Uquhpt-UOapFWlfNsf7PD0M3AA1A0yUqPr7OCUl9sol84x0z4MT8Z2xa6MKRLMwA2EJBoHbyK88Vb2yAF7Va4diO1MVUYaOqWtlQidEOqC0L4f2K9ShuyRgcHqwKoCEQysNQh52hK7nApHWna7I2VfLpg6Koz-VCoxI9HmYXC-SBF5vFzl3rLRMBZdq-';

            $gallery = [
                [
                    'title' => 'Practical Chemistry & Physics Labs',
                    'category' => 'academics',
                    'category_label' => 'Academics',
                    'description' => 'Every student conducts real individual experiments under skilled faculty oversight in our fully-equipped chemistry and physics laboratories.',
                    'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrzXDUKrgMDRbDSMPQkvk-d04XK9p5NLWa2FLGO6EA1J6mnAjmo6zEzws0p4TnTcp_yHRu8mHHrYtrArJyfbcnj5IZUatcM1-D-tAHeahzWR-5ewQulXHOTDSF0-0yGGHEyOqsAJhv4vK1ykCB5imnMb1rtS6UfKJYYH6ErkItCzeiVVlhhbuK3Kzmner9Y_Fkd2N2cl2dSb2yeebn00MLwbXPgGQR-fCzct26PeoCRiIYkSM8NqAk',
                    'alt_text' => 'High school science students in white lab coats conducting a titration chemistry experiment in a modern school laboratory.',
                    'span_class' => 'lg:col-span-7',
                    'order_index' => 1,
                    'is_active' => true,
                ],
                [
                    'title' => 'Inter-House Football & Track Glory',
                    'category' => 'sports',
                    'category_label' => 'Sports & Games',
                    'description' => 'Nurturing physical fitness, disciplined teamwork, and regional sports champions on our championship green grounds.',
                    'image_path' => $sportsUrl,
                    'alt_text' => 'Ugandan secondary school football and athletics teams running on an expansive emerald green sports pitch near Entebbe.',
                    'span_class' => 'lg:col-span-5',
                    'order_index' => 2,
                    'is_active' => true,
                ],
                [
                    'title' => 'Music, Dance, Drama & Brass Band',
                    'category' => 'arts',
                    'category_label' => 'Arts & Culture',
                    'description' => "Celebrating Uganda's cultural heritage, creative expression, and rhythmic musical mastery at regional and national festivals.",
                    'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBxxVnr6eUSYAg-HwQtiUDZ_qB6t0pRkM--DNsWLzHSTvg4dugzfguA-FuUAdkJwuMu7UA9g7fxzkCrSZ8ZmQxwSUB33B_L6S_irm6d9knbGCzJ4PN5oXl_1cit6zxdUUxn1BdRpioPt3-nkHLLONvqzUdq2QjttKd-vj-GzbYEmw5D1ZeG0QDcAkuxvAM54aYHBaVfvCT0YavX0kTunsnoap0qb5ijytV9vM-n3MkUsE_C28ItgMN7',
                    'alt_text' => 'A disciplined high school marching brass band in crimson and gold uniforms playing trumpets and drums during a national day parade in Entebbe.',
                    'span_class' => 'lg:col-span-4',
                    'order_index' => 3,
                    'is_active' => true,
                ],
                [
                    'title' => 'Memorial Reference Library',
                    'category' => 'academics',
                    'category_label' => 'Academics',
                    'description' => 'Over 15,000 catalogued curriculum texts, scholastic references, and high-speed digital research terminals in a serene sanctuary.',
                    'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAv2ghDK11XxGbBrSinubyiL8pvjnzYIbH-06EdIjkoox3j5GG2UrVI2p4MTs3CBZnou-gjs2HRBfmMvzEt-znPKrwGommOg9DJLGTDJOxldQDqjNWnc4S8ZHlC1lGbKNLqQ_Tcv3aAD1WUhB18ia-3evuSkODKDpKFr0WJ1IJtbQC9dgxcOxiPvICvIsS8bwwy785qGLIpOQD2LQKUtV9oA_NNxEmPGagWimDIOZ-Vh70E6IBIe-W8',
                    'alt_text' => 'A serene, sunlit school library with students seated around polished wooden study tables, engrossed in textbooks and research journals.',
                    'span_class' => 'lg:col-span-4',
                    'order_index' => 4,
                    'is_active' => true,
                ],
                [
                    'title' => 'Lakeside Field Studies',
                    'category' => 'campus',
                    'category_label' => 'Campus Grounds',
                    'description' => "Harnessing Entebbe's botanical and aquatic biodiversity for real-world environmental biology and geography research expeditions.",
                    'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCEpXGMX8iCFUvVuDz6dEYyeH3BxMTeBrSQ-bTFLhQrZaqEUjecYb7fYgMeqQs0xi0-8lCZZghsC3K9Ij0C8Q9P2Uzc3h2cpOd_A3CysciRNi1wNhDVazr-_zuAWIN1xtzAH3O5qdf3dqG6tQQjsU2fD1fLlLDMw9Op5io0PweGl-b9B1kZf3PyaEQEmJM_j7pMPA1a1aE0FTV8jr-o41KwMZ1g3OTqnzNeuYh0BpsFgakaC_WrkNIH',
                    'alt_text' => 'Geography and biology students on an environmental field trip along the shores of Lake Victoria in Entebbe.',
                    'span_class' => 'lg:col-span-4',
                    'order_index' => 5,
                    'is_active' => true,
                ],
                [
                    'title' => 'Lakeside Quad & Botanical Gardens',
                    'category' => 'campus',
                    'category_label' => 'Campus Grounds',
                    'description' => 'Serene botanical gardens and manicured collegiate lawns overlooking the Lake Victoria horizon, providing an inspiring and peaceful academic sanctuary.',
                    'image_path' => $heroUrl,
                    'alt_text' => 'Lush green botanical quad and manicured lawns of Sena High School in Entebbe with students resting under tropical palm trees.',
                    'span_class' => 'lg:col-span-6',
                    'order_index' => 6,
                    'is_active' => true,
                ],
                [
                    'title' => 'Championship Sports Complex & Courts',
                    'category' => 'sports',
                    'category_label' => 'Sports & Games',
                    'description' => 'State-of-the-art basketball, volleyball, and multi-purpose courts promoting physical agility, healthy competition, and house spirit.',
                    'image_path' => $sportsUrl,
                    'alt_text' => 'High school students competing energetically in outdoor volleyball and athletics matches on school grounds in Entebbe.',
                    'span_class' => 'lg:col-span-6',
                    'order_index' => 7,
                    'is_active' => true,
                ],
            ];

            foreach ($gallery as $item) {
                GalleryItem::create($item);
            }
        }

        // 4. ADMISSION REQUIREMENTS
        if (AdmissionRequirement::count() === 0) {
            $requirements = [
                'Certified PLE or UCE UNEB result slip / pass slip or equivalent transcripts.',
                'Original recommendation letter from previous head of school.',
                'Copy of birth certificate & 4 recent colored passport-sized photographs.',
                'Medical assessment report from an authorized clinic or hospital.',
            ];

            foreach ($requirements as $index => $req) {
                AdmissionRequirement::create([
                    'requirement_text' => $req,
                    'order_index' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
