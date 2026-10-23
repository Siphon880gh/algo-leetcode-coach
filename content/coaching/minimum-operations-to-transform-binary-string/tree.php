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
            'message' => "Read the problem statement above.\nPair a 1 with which neighbour?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either side, via the DP', 'next' => 's2'],
                ['label' => 'Only the next index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → −1 instead of 3.\nStep back to when you only looked right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Position in two clears?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No extra set', 'next' => 'wrong_b'],
                ['label' => 'Needs a set between them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"111\" → \"000\" → 2 instead of 3.\nStep back to when you skipped the refill.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
