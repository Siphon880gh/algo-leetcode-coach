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
            'message' => "Read the problem statement above.\nWhich roads count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Roads in city 1’s component', 'next' => 's2'],
                ['label' => 'Every road in the input', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Other components are unreachable; n = 4, roads [[1,4,5],[2,3,1]] → 1 instead of 5.\nStep back to when you took every road.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Must the path be simple?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, take the best simple path', 'next' => 'wrong_b'],
                ['label' => 'No, it may repeat roads', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A detour can pick up a smaller road; n = 4, roads [[1,2,9],[2,4,9],[2,3,1]] → 9 instead of 1.\nStep back to when you required a simple path.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
