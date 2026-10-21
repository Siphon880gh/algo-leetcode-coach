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
            'message' => "Read the problem statement above.\nWhich word can be absorbed by \"time\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"me", a suffix', 'next' => 's2'],
                ['label' => '"tim", a prefix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each encoded word ends at a #, so only suffixes share.\nStep back to when you used a prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you drop absorbed words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort and compare neighbors', 'next' => 'wrong_b'],
                ['label' => 'Put words in a set and remove every proper suffix of each word', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorting groups prefixes, not suffixes (unless you reverse the words first).\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does each kept word cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its length plus 1 for the #', 'next' => 'success'],
                ['label' => 'Its length', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every kept word needs its own #.\nStep back to when you forgot the #.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ len²). [\"time\",\"me\",\"bell\"] → 10. [\"t\"] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
