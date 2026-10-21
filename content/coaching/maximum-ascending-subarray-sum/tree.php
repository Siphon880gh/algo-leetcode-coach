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
            'message' => "Read the problem statement above.\nEqual neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the run', 'next' => 's2'],
                ['label' => 'Continue the run', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The subarray must be strictly increasing.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reset value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'The current element', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The current element starts the new run.\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Update the best when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every step', 'next' => 'success'],
                ['label' => 'Only when a run breaks', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The final run never breaks inside the loop.\nStep back to when you updated only at breaks.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 65, 150, 33.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
