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
            'message' => "Read the problem statement above.\nHow do you count trailing zeros of x!?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x // 5 + x // 25 + x // 125 + …', 'next' => 's2'],
                ['label' => 'Compute x! and count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. x! is astronomically large.\nStep back to when you computed the factorial.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many x share a reachable count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It varies', 'next' => 'wrong_b'],
                ['label' => 'Exactly 5', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The count only changes at multiples of 5, so each value spans a block of 5.\nStep back to when you expected variation.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can a count be skipped?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: at 25, 125, … the count jumps by more than 1, so the answer can be 0', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 24! has 4 zeros and 25! has 6; no x gives 5.\nStep back to when you ruled out skips.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log² k). k = 0 → 5. k = 5 → 0. k = 3 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
