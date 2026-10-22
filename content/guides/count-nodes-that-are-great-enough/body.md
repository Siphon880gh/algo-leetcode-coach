Given a binary tree and an integer k, count the nodes whose subtree has enough nodes and whose value is larger than at least k of the values in their subtree. The exact condition, including how the node itself and ties are counted, and the limits are in the official statement. For instance, with root 7 and children 3 and 5, and k = 2, only the root counts, so the answer is 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Bottom-up k smallest

This assumes the comparison is against the node’s descendants, with ties not counting. Adapt it if the statement says otherwise.

1. Post-order: `L` = the merged k-smallest lists of the children.
2. The node counts if `|L| ≥ k` and `node.val > L[k − 1]`.
3. Pass up the k smallest of L plus the node’s own value.

Constructed checks (run in code): the example above → 1; 300 random trees with k ≤ 3 match counting directly in every subtree.

Only the k smallest matter, because the node counts exactly when it beats the k-th smallest. Collecting whole subtrees instead costs O(n²) on a path.

Time: O(n · k log k)  
Space: O(n · k)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
