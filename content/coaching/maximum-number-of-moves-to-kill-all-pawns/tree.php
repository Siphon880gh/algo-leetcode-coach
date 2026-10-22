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
            'message' => "Read the problem statement above.\nPlay how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minimax DP over masks', 'next' => 's2'],
                ['label' => 'Greedy: Alice farthest, Bob nearest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 6 instead of 8.\nStep back to when you played greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Who maximises?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every move maximises', 'next' => 'wrong_b'],
                ['label' => 'Alice when an even number of pawns are gone', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Knight at (0, 0), pawns (5, 4), (0, 4), (0, 3) → 10 instead of 9.\nStep back to when every move maximised.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(16 · 2500 + 2^n · n²). Examples → 4, 8, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
