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
            'message' => "Read the problem statement above.\nWhere do the missing stations go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(i + r, n − 1)', 'next' => 's2'],
                ['label' => 'At city i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A station further right covers more later cities; stations = [0,0,0], r = 1, k = 1 → 0 instead of 1.\nStep back to when you built at i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Upper bound of the search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest current power', 'next' => 'wrong_b'],
                ['label' => 'Σ stations + k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. New stations can lift every city above today’s maximum; stations = [0], r = 0, k = 5 → 0 instead of 5.\nStep back to when you capped the search.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(Σ stations + k)). Examples → 5, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
