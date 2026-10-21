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
            'message' => "Read the problem statement above.\nWhat does the dash count give you?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The node\'s depth', 'next' => 's2'],
                ['label' => 'The node\'s value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Digits after the dashes are the value.\nStep back to when you read dashes as the value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stack is deeper than the new node's depth. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Attach to the top anyway', 'next' => 'wrong_b'],
                ['label' => 'Pop until its size equals the depth', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The top is not the parent.\nStep back to when you attached to the top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The parent already has a left child. Attach where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As the right child', 'next' => 'success'],
                ['label' => 'Replace the left child', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Preorder fills left first, then right.\nStep back to when you replaced the left child.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"1-2--3--4-5--6--7\" → [1,2,5,3,4,6,7]. \"1-2--3---4-5--6---7\" → [1,2,5,3,null,6,null,4,null,7]. \"1-401--349---90--88\" → [1,401,null,349,88,90].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
