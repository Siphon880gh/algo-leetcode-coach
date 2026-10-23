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
            'message' => "Problem: You start on the ground at height 0 and must land on every block exactly once, in any order. A jump from height a to height b costs (a − b)² calories, and the first jump goes from 0 to the first block. Return the most calories you can burn. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nOrder of jumps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alternate between the two ends of the sorted list', 'next' => 's2'],
                ['label' => 'Ascending heights', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Made-up [2, 6, 4] → 12 instead of 56.\nStep back to when you climbed in order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First block?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The shortest', 'next' => 'wrong_b'],
                ['label' => 'The tallest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Made-up [2, 6, 4] → 24 instead of 56.\nStep back to when you started low.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 56, 25, 255.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
