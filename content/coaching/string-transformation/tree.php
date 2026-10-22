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
            'message' => "Read the problem statement above.\nFind rotations equal to t with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The Z-function on t + # + s + s', 'next' => 's2'],
                ['label' => 'Comparing every rotation', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is O(n²), about 2.5 · 10^11 for n = 5 · 10^5.\nStep back to when you compared rotations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Apply the k-step recurrence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One step at a time', 'next' => 'wrong_b'],
                ['label' => 'By matrix squaring', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k reaches 10^15.\nStep back to when you looped k times.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + log k). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
