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
            'message' => "Read the problem statement above.\nIs \"Apple\" a vowel word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: check vowels in either case', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Vowel checks are case-insensitive.\nStep back to when you checked lowercase only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A word starts with a consonant. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the first letter', 'next' => 'wrong_b'],
                ['label' => 'Move the first letter to the end, then add "ma"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The letter moves; it is not removed.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many \"a\" does the third word get?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'success'],
                ['label' => '2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Word numbering starts at 1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + words²). \"I speak Goat Latin\" → \"Imaa peaksmaaa oatGmaaaa atinLmaaaaa\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
