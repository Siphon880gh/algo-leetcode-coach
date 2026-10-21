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
            'message' => "Read the problem statement above.\nBoth A and B empty on the same serving. Value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0.5: half credit for a tie', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem adds half the probability that both empty at once.\nStep back to when you gave full credit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why scale n by 25?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'For rounding only', 'next' => 'wrong_b'],
                ['label' => 'Every serving is a multiple of 25, so units shrink the state space', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It cuts the states by a factor of 625.\nStep back to when you kept milliliters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 10⁹. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 1: beyond about 4800 the answer is within 10⁻⁵ of 1', 'next' => 'success'],
                ['label' => 'Run the memo anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The memo table would be enormous.\nStep back to when you ran the recursion.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m²) with m ≤ 192. n = 50 → 0.625. n = 100 → 0.71875.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
