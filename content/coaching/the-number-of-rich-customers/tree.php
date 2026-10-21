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
            'message' => "Problem: A table of bills lists a bill id, a customer id and an amount. A customer is rich if at least one of their bills has an amount above a threshold the statement gives. Report the number of rich customers. For instance, with a sample threshold of 500 and bills of 549 and 834 for customer 1, 394 for customer 2, and 657 and 257 for customer 3, the answer is 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct customer ids', 'next' => 's2'],
                ['label' => 'Qualifying bills', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In the sample, customer 1 has two bills over 500, giving 3 instead of 2.\nStep back to when you counted bills.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare which amount with the threshold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each customer\'s total', 'next' => 'wrong_b'],
                ['label' => 'Each single bill', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A customer is rich when one bill is above the threshold; two bills of 300 do not qualify.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One number', 'next' => 'success'],
                ['label' => 'A list of customer ids', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for the count.\nStep back to when you listed ids.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
