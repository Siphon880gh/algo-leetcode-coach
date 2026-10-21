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
            'message' => "Read the problem statement above.\nDistance test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare squared distance with r²', 'next' => 's2'],
                ['label' => 'Use sqrt and compare with r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Floating roots can misjudge border points.\nStep back to when you took sqrt.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Border points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Outside (<)', 'next' => 'wrong_b'],
                ['label' => 'Inside (≤)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement counts the border as inside.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(points · queries) = 2.5 · 10^5', 'next' => 'success'],
                ['label' => 'Needs a k-d tree', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The double loop is tiny here.\nStep back to when you built a tree.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · q). Examples → [3,2,2], [2,3,2,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
