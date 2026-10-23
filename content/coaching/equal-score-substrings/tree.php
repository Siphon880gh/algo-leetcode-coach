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
            'message' => "Read the problem statement above.\nWhich splits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every split point', 'next' => 's2'],
                ['label' => 'Only the middle one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): \"aab\" → false instead of true.\nStep back to when you tried only the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test for a split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'prefix = total / 2 with integer division', 'next' => 'wrong_b'],
                ['label' => '2 · prefix = total', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"ab\" → true instead of false (3 / 2 rounds down to 1).\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
