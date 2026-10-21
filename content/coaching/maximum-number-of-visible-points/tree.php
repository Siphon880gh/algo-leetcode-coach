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
            'message' => "Read the problem statement above.\nPoints at the location?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always visible; count separately', 'next' => 's2'],
                ['label' => 'Compute their angle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. atan2(0, 0) is meaningless.\nStep back to when you took their angle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Wrap-around?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Append each angle + 360', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A view can span 359° and 1°.\nStep back to when you ignored wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Floating point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with a small epsilon', 'next' => 'success'],
                ['label' => 'Exact equality', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Angles from atan2 carry rounding error.\nStep back to when you compared exactly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
