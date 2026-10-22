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
            'message' => "Read the problem statement above.\nCompute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fast modular powers', 'next' => 's2'],
                ['label' => 'Full powers, then mod', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. (a^b)^c can have about 3 · 10^6 digits.\nStep back to when you computed full powers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First reduction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mod m', 'next' => 'wrong_b'],
                ['label' => 'mod 10', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The formula takes the last digit first; [3, 3, 1, 7] gives 27 mod 10 = 7, then 0, but 27 mod 7 = 6.\nStep back to when you reduced by m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(bc)). Examples → [0, 2], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
