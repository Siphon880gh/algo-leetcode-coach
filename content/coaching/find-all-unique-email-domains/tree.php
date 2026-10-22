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
            'message' => "Problem: A table lists email addresses. Report each distinct domain that matches the rule the statement gives (for instance, a required ending) and how many addresses use it. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nDomain is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Text after @', 'next' => 's2'],
                ['label' => 'Text after the last dot', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The check groups com 3, org 1, au 1.\nStep back to when you split at the dot.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Email contains it anywhere', 'next' => 'wrong_b'],
                ['label' => 'Domain ends with the rule', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The check also keeps x.com.au.\nStep back to when you matched a substring.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → x.com 2, z.com 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
