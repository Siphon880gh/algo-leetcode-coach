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
            'message' => "Problem: With the same product and sales tables, report the buyers who bought one named product but never another. From memory, the statement uses an S8 phone and an iPhone; check the exact names there. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter WHERE product_name = 'S8' first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: you would lose the iPhone rows you must check', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The exclusion needs every purchase.\nStep back to when you filtered first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'seller_id', 'next' => 'wrong_b'],
                ['label' => 'buyer_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The question is about buyers.\nStep back to when you grouped by seller.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which HAVING?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'S8 count > 0 and iPhone count = 0', 'next' => 'success'],
                ['label' => 'S8 count > iPhone count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any iPhone purchase disqualifies the buyer.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. Buyers with an S8 and no iPhone are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
