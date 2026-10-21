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
            'message' => "Read the problem statement above.\nTry each deletion with a fresh Kadane?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two running states', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried each deletion.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New deleted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(deleted + x, keep + x)', 'next' => 'wrong_b'],
                ['label' => 'max(deleted + x, old keep)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Old keep means x itself is the deleted element.\nStep back to when you added x to keep.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All values negative. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest single value', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At least one element must remain.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,−2,0,3] → 4. [1,−2,−2,3] → 3. [−1,−1,−1,−1] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
