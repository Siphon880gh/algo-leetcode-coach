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
            'message' => "Read the problem statement above.\nWhich neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right and down only', 'next' => 's2'],
                ['label' => 'All four', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each edge would be processed twice and look like a cycle.\nStep back to when you used all four.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cycle signal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A cell with two same neighbours', 'next' => 'wrong_b'],
                ['label' => 'find(a) == find(b) before union', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path cell also has two.\nStep back to when you counted neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DFS instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the parent cell; watch recursion depth', 'next' => 'success'],
                ['label' => 'Plain visited check', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The parent would look like a cycle.\nStep back to when you ignored the parent.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn α). The two ring examples → true. Example 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
