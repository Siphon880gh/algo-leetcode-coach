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
            'message' => "Read the problem statement above.\nWhich node links to list2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node a − 1', 'next' => 's2'],
                ['label' => 'Node a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Node a itself is removed.\nStep back to when you used node a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tail connects to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node b', 'next' => 'wrong_b'],
                ['label' => 'Node b + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Node b is removed too.\nStep back to when you used node b.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to save node b + 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before relinking', 'next' => 'success'],
                ['label' => 'After relinking', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Relinking may lose the path to it.\nStep back to when you relinked first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Example 1 → [10,1,13,1000000,1000001,1000002,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
