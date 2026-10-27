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
            'message' => "Read the problem statement above.\nAn edge joins a W node and an R node. Which one is the parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The W node, since R follows W', 'next' => 's2'],
                ['label' => 'Either, depending on the root', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. All three sequences are the cycle W, R, B, so a child is always one step after its parent.\nStep back to when you left the edge open.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Star: node 0 is R with three B neighbours. Is 0 a valid root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it would have three children', 'next' => 'success'],
                ['label' => 'Yes, every edge steps from R to B', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Node 0 would have three children, which breaks the binary-tree rule. The answer is −1.\nStep back to when you accepted the star.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Orient edges by color and check the parent counts. O(n). Examples give 3 and −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
