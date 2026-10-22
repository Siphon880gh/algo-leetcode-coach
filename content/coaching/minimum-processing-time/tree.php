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
            'message' => "Read the problem statement above.\nSort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Processors ascending, tasks descending', 'next' => 's2'],
                ['label' => 'Both ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The earliest processor gets the shortest tasks; example 1 → 18 instead of 16.\nStep back to when you sorted both the same way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A processor finishes at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its time + the sum of its tasks', 'next' => 'wrong_b'],
                ['label' => 'Its time + its longest task', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Its four cores run in parallel; example 1 → 32 instead of 16.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 16, 23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
