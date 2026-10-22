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
            'message' => "Read the problem statement above.\nReturn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(arrival + delay) mod 24', 'next' => 's2'],
                ['label' => 'arrival + delay', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 24 must read as 0; Example 2 → 24 instead of 0.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Wrap at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '12', 'next' => 'wrong_b'],
                ['label' => '24', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The clock is 24-hour; Example 1 → 8 instead of 20.\nStep back to when you used 12.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 20, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
