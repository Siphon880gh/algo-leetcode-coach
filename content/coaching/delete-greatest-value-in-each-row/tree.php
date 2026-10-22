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
            'message' => "Read the problem statement above.\nAdd per round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest of the removed values', 'next' => 's2'],
                ['label' => 'The sum of the removed values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only the maximum counts; Example 1 → 14 instead of 8.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All values together, taking m at a time', 'next' => 'wrong_b'],
                ['label' => 'Each row on its own', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each round takes one value from every row; [[1,2],[3,4]] → 6 instead of 7.\nStep back to when you mixed the rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log n). Examples → 8, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
