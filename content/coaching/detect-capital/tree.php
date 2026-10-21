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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count uppercase letters', 'next' => 's2'],
                ['label' => 'Only check whether the first letter is uppercase', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Checking only the first letter accepts \"FlaG\".\nStep back to when you checked just word[0].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "cnt == 1.\nIs that enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, one capital is always fine', 'next' => 'wrong_b'],
                ['label' => 'Only if word[0] is the uppercase one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"leetCode\" has one capital in the wrong place.\nStep back to when you accepted any single capital.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Valid: cnt == 0, cnt == len(word), or cnt == 1 and word[0].isupper(). O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three cases on the uppercase count', 'next' => 'success'],
                ['label' => 'Reject single uppercase letters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"A\" is valid; len is 1 and cnt is 1, which matches all-uppercase.\nStep back to when you rejected one-letter words.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count capitals and check three cases. \"FlaG\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
