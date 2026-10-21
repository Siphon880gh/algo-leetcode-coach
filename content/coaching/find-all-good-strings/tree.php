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
            'message' => "Read the problem statement above.\nTrack evil how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'KMP matched length', 'next' => 's2'],
                ['label' => 'Reset to 0 on mismatch', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Overlapping prefixes would be missed.\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count ≤ s2 only', 'next' => 'wrong_b'],
                ['label' => 'Two tight flags at once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The lower bound s1 matters too.\nStep back to when you ignored s1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Matched all of evil?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0 for that branch', 'next' => 'success'],
                ['label' => 'Keep going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The string already contains evil.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · |evil| · 26). (2, \"aa\", \"da\", \"b\") → 51. (\"gx\", \"gz\", \"x\") → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
