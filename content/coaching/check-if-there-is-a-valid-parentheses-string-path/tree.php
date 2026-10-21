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
            'message' => "Read the problem statement above.\nWhat to store per cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every reachable balance', 'next' => 's2'],
                ['label' => 'Only the largest balance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The largest balance can be the one that cannot close; the 4 × 3 grid ((( / ()( / ))( / )() → false instead of true.\nStep back to when you kept only the largest balance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A balance goes below 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it and hope it recovers', 'next' => 'wrong_b'],
                ['label' => 'Drop it there', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The 1 × 2 grid )( ends at 0 but starts with an unmatched ) → true instead of false.\nStep back to when you kept negative balances.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Accept at the bottom-right when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Balance exactly 0 is reachable', 'next' => 'success'],
                ['label' => 'Any non-negative balance is reachable', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The 1 × 2 grid (( ends at 2 → true instead of false.\nStep back to when you accepted any balance.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · (m + n)). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
