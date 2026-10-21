<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nMay the substring contain a consonant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only vowels', 'next' => 's2'],
                ['label' => 'Yes, if all five vowels appear', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A vowel substring consists only of vowels; Example 2 → 0.\nStep back to when you allowed consonants.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which vowels must appear?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least one', 'next' => 'wrong_b'],
                ['label' => 'All five', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. aeiouu → 2, not 21.\nStep back to when you accepted one vowel.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After a consonant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop extending this start', 'next' => 'success'],
                ['label' => 'Skip it and continue', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A substring through a consonant is no longer vowel-only.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) for n ≤ 100. Examples → 2, 0, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
