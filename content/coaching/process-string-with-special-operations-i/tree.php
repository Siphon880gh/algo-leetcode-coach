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
            'message' => "Read the problem statement above.\n# does?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r = r + r', 'next' => 's2'],
                ['label' => 'Repeat the last character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. \"ab#\" → abb instead of abab.\nStep back to when you repeated one character.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With a lazy reverse flag, * pops?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The stored last character', 'next' => 'wrong_b'],
                ['label' => 'The logical last character', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → aa instead of ba.\nStep back to when you popped the stored end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · |result|). Examples → ba, \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
