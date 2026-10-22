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
            'message' => "Read the problem statement above.\nWindow length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly k', 'next' => 's2'],
                ['label' => 'Any length up to k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A short all-black window is not k blocks; Example 1 → 0 instead of 3.\nStep back to when you allowed shorter windows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of a window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its number of B', 'next' => 'wrong_b'],
                ['label' => 'Its number of W', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Black blocks need no recolouring; Example 2 → 1 instead of 0.\nStep back to when you counted B.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sliding right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the entering block and remove the leaving one', 'next' => 'success'],
                ['label' => 'Only add the entering block', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The count keeps old blocks; Example 2 → 1 instead of 0.\nStep back to when you skipped the leaving block.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
