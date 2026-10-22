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
            'message' => "Read the problem statement above.\nReturn the value before or after increasing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before: n++', 'next' => 's2'],
                ['label' => 'After: ++n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first call must return n itself; Example 1 → [11,12,13] instead of [10,11,12].\nStep back to when you pre-incremented.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does n live?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In one shared outer variable', 'next' => 'wrong_b'],
                ['label' => 'In the closure of each counter', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A second counter overwrites the first; createCounter(10), then createCounter(−2), then calling the first → −2 instead of 10.\nStep back to when you shared n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [10,11,12], [−2,−1,0,1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
