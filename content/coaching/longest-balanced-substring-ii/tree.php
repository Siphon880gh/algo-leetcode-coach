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
            'message' => "Read the problem statement above.\nOne-letter substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include them: the longest run', 'next' => 's2'],
                ['label' => 'Skip them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): \"aaab\" → 2 instead of 3.\nStep back to when you skipped runs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two-letter case and the third letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it and keep going', 'next' => 'wrong_b'],
                ['label' => 'Reset the map at every third letter', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"abcab\" → 5 instead of 3.\nStep back to when you skipped the reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
