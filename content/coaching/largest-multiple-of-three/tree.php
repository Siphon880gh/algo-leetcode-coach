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
            'message' => "Read the problem statement above.\nRemainder r, first try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop one smallest digit ≡ r', 'next' => 's2'],
                ['label' => 'Drop two digits ≡ 3 − r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One digit removed keeps the number longer.\nStep back to when you dropped two first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which digits to drop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest', 'next' => 'wrong_b'],
                ['label' => 'The smallest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Large digits should stay at the front.\nStep back to when you dropped the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Result 000?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"0"', 'next' => 'success'],
                ['label' => '"000"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros collapse.\nStep back to when you returned 000.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [8,1,9] → \"981\". [8,6,7,1,0] → \"8760\". [1] → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
