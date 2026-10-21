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
            'message' => "Read the problem statement above.\nWhich words are prices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '$ followed only by digits, at least one', 'next' => 's2'],
                ['label' => 'Any word starting with $', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 would try to discount \$10\$, and a lone \$ has no number.\nStep back to when you accepted any \$ word.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New price?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'price · discount / 100', 'next' => 'wrong_b'],
                ['label' => 'price · (100 − discount) / 100', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \$1 with discount 20 → \$0.20 instead of \$0.80.\nStep back to when you kept the discount part.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Format?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always two decimals', 'next' => 'success'],
                ['label' => 'Drop trailing zeros', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → \$0.5 \$1 instead of \$0.50 \$1.00.\nStep back to when you trimmed zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → there are \$0.50 \$1.00 and 5\$ candies in the shop; 1 2 \$0.00 4 \$0.00 \$0.00 7 8\$ \$0.00 \$10\$.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
