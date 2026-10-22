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
            'message' => "Read the problem statement above.\nTry component counts k in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From n down, stop at the first that works', 'next' => 's2'],
                ['label' => 'From 1 up, stop at the first that works', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. k = 1 always works; Example 1 → 0 instead of 2.\nStep back to when you counted up.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A subtree sums exactly to the target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return its sum to the parent', 'next' => 'wrong_b'],
                ['label' => 'Cut it: return 0 to the parent', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The parent then overshoots and the split fails; Example 1 → 0 instead of 2.\nStep back to when you passed the sum up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · d(S)). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
