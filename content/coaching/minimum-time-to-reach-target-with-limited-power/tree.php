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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(node, power left)', 'next' => 's2'],
                ['label' => 'Node only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): n = 4, edges [[0, 2, 4], [0, 1, 1], [1, 2, 2], [2, 3, 5]], power = 8, cost = [2, 4, 3, 5], 0 → 3 → [−1, −1] instead of [9, 3].\nStep back to when you kept one state per node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'wrong_b'],
                ['label' => 'Prefer more power', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): edges [[0, 2, 1], [2, 3, 1], [0, 1, 1], [1, 3, 1]], power = 5, cost = [1, 1, 3, 1], 0 → 3: both paths take 2, and the one through node 2 leaves 1 instead of 3.\nStep back to when you ignored power on ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(P · (n + E) log(P · n)). Examples → [3, 0], [0, 3], [−1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
