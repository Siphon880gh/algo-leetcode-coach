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
            'message' => "Read the problem statement above.\nWhich values to change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two from the ends, in any of three ways', 'next' => 's2'],
                ['label' => 'Always the two largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The two smallest or one of each can be better; Example 1 → 4 instead of 3.\nStep back to when you fixed the two largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Include one smallest plus one largest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only both from one end', 'next' => 'wrong_b'],
                ['label' => 'Yes, a[n − 2] − a[1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The mixed trim can win; nums = [0,10,11,12,20] → 9 instead of 2.\nStep back to when you dropped the mixed option.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
