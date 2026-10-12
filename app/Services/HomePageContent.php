<?php

namespace App\Services;

use App\Models\SiteContent;

class HomePageContent
{
    public function __construct(private RichTextSanitizer $sanitizer) {}

    /**
     * @return array<string, array{label: string, type: 'text'|'rich'}>
     */
    public function fields(): array
    {
        return [
            'hero_eyebrow' => ['label' => 'Hero eyebrow', 'type' => 'text'],
            'hero_title' => ['label' => 'Hero heading', 'type' => 'text'],
            'hero_description' => ['label' => 'Hero introduction', 'type' => 'rich'],
            'approach_eyebrow' => ['label' => 'Approach eyebrow', 'type' => 'text'],
            'approach_title' => ['label' => 'Approach heading', 'type' => 'text'],
            'approach_description' => ['label' => 'Approach introduction', 'type' => 'rich'],
            'value_1_title' => ['label' => 'First value heading', 'type' => 'text'],
            'value_1_description' => ['label' => 'First value description', 'type' => 'rich'],
            'value_2_title' => ['label' => 'Second value heading', 'type' => 'text'],
            'value_2_description' => ['label' => 'Second value description', 'type' => 'rich'],
            'value_3_title' => ['label' => 'Third value heading', 'type' => 'text'],
            'value_3_description' => ['label' => 'Third value description', 'type' => 'rich'],
            'about_eyebrow' => ['label' => 'About eyebrow', 'type' => 'text'],
            'about_title' => ['label' => 'About heading', 'type' => 'text'],
            'about_paragraph_one' => ['label' => 'About paragraph one', 'type' => 'rich'],
            'about_paragraph_two' => ['label' => 'About paragraph two', 'type' => 'rich'],
            'support_eyebrow' => ['label' => 'Counseling eyebrow', 'type' => 'text'],
            'support_title' => ['label' => 'Counseling heading', 'type' => 'text'],
            'support_description' => ['label' => 'Counseling introduction', 'type' => 'rich'],
            'in_person_title' => ['label' => 'In-person counseling heading', 'type' => 'text'],
            'in_person_description' => ['label' => 'In-person counseling description', 'type' => 'rich'],
            'virtual_title' => ['label' => 'Virtual counseling heading', 'type' => 'text'],
            'virtual_description' => ['label' => 'Virtual counseling description', 'type' => 'rich'],
            'closing_title' => ['label' => 'Closing heading', 'type' => 'text'],
            'closing_description' => ['label' => 'Closing message', 'type' => 'text'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function defaults(): array
    {
        return [
            'hero_eyebrow' => 'Compassionate mental health support across Nepal',
            'hero_title' => 'A gentler space to find your way forward.',
            'hero_description' => '<p>Understanding how you feel is a meaningful first step. Find a safe, respectful space to reflect, be heard, and access professional support.</p>',
            'approach_eyebrow' => 'Care that sees the whole person',
            'approach_title' => 'Support for more than just the hard days.',
            'approach_description' => '<p>Mental health care can help us meet challenges, understand ourselves, and grow. We believe support should be accessible, compassionate, and available before a difficult moment becomes a crisis.</p>',
            'value_1_title' => 'A space to be heard',
            'value_1_description' => '<p>Compassionate, confidential support in a safe, respectful, and non-judgmental environment.</p>',
            'value_2_title' => 'Support that meets you',
            'value_2_description' => '<p>Professional counseling offered through physical and virtual platforms for people across Nepal.</p>',
            'value_3_title' => 'Room to grow',
            'value_3_description' => '<p>Care that values early support, prevention, emotional well-being, and personal growth.</p>',
            'about_eyebrow' => 'About Bhavdarpan',
            'about_title' => 'A little more understanding can change how we move forward.',
            'about_paragraph_one' => '<p>Bhavdarpan is a mental health service organization dedicated to compassionate, confidential, and accessible support across Nepal. Our name reflects the belief that understanding our emotions and accepting our experiences can help us find a path toward healing.</p>',
            'about_paragraph_two' => '<p>When access is limited and stigma makes it harder to ask for help, reaching out can feel like a big step. We want to make professional counseling available to people from diverse backgrounds, both in person and virtually.</p>',
            'support_eyebrow' => 'A more accessible way to seek support',
            'support_title' => 'Care that can meet you where you are.',
            'support_description' => '<p>Different people need different ways to connect. Bhavdarpan offers counseling through both physical and virtual platforms.</p>',
            'in_person_title' => 'In-person counseling',
            'in_person_description' => '<p>A face-to-face option for professional support in a safe and respectful environment.</p>',
            'virtual_title' => 'Virtual counseling',
            'virtual_description' => '<p>A way to access professional support remotely, wherever you are in Nepal.</p>',
            'closing_title' => 'Your experience deserves care, not judgment.',
            'closing_description' => 'Reflect. Acknowledge. Heal. One step at a time.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function get(): array
    {
        $savedContent = SiteContent::query()->where('key', 'home_page')->first()?->content ?? [];
        $content = array_replace($this->defaults(), $savedContent);

        foreach ($this->fields() as $key => $field) {
            if ($field['type'] === 'text') {
                $content[$key] = strip_tags($content[$key]);
            } else {
                $content[$key] = $this->sanitizer->sanitize($content[$key]);
            }
        }

        return $content;
    }

    /**
     * @param  array<string, string>  $content
     * @return array<string, string>
     */
    public function sanitize(array $content): array
    {
        foreach ($this->fields() as $key => $field) {
            if ($field['type'] === 'rich') {
                $content[$key] = $this->sanitizer->sanitize($content[$key]);
            } else {
                $content[$key] = trim(strip_tags($content[$key]));
            }
        }

        return $content;
    }
}
