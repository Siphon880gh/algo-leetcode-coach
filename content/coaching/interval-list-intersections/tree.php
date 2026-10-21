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
            'message' => "Read the problem statement above.\nCompare every pair of intervals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two pointers, since both lists are sorted and disjoint', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · m).\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "lo = max(starts), hi = min(ends). Keep it when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo < hi', 'next' => 'wrong_b'],
                ['label' => 'lo ≤ hi', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Touching endpoints like [5,5] count.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which pointer moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one whose interval ends first', 'next' => 'success'],
                ['label' => 'Both', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The other interval may still overlap the next one.\nStep back to when you moved both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). A = [[0,2],[5,10],[13,23],[24,25]], B = [[1,5],[8,12],[15,24],[25,26]] → [[1,2],[5,5],[8,10],[15,23],[24,24],[25,25]]. A = [[1,3],[5,9]], B = [] → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
