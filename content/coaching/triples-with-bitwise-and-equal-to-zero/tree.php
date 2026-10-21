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
            'message' => "Read the problem statement above.\nLoop over all triples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count pair ANDs first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n = 1000 gives 10⁹ triples.\nStep back to when you looped over triples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ordered or unordered pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unordered', 'next' => 'wrong_b'],
                ['label' => 'Ordered: (i, j, k) is an ordered triple with repeats allowed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem counts ordered triples, including i = j.\nStep back to when you used unordered pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For a given k, which buckets count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every m with m & k == 0', 'next' => 'success'],
                ['label' => 'Only m == 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A pair AND only needs to miss k's bits.\nStep back to when you required m == 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² + n · 2¹⁶). [2,1,3] → 12. [0,0,0] → 27.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
