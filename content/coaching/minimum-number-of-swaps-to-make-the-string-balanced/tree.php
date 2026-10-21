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
            'message' => "Read the problem statement above.\nTrack what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Maximum prefix excess of ]', 'next' => 's2'],
                ['label' => 'Total count of ]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counts are always equal by the constraints.\nStep back to when you counted totals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swaps for excess m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm', 'next' => 'wrong_b'],
                ['label' => 'ceil(m / 2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One swap fixes two units.\nStep back to when you used m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which swap is best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First excess ] with the last [', 'next' => 'success'],
                ['label' => 'Adjacent swaps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adjacent swaps fix only one unit.\nStep back to when you swapped neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
