## Flatten, then search

1. In-order traversal into sorted `a`.
2. For query `q`: `i = upper_bound(a, q)`; min is `a[i − 1]` or −1. `j = lower_bound(a, q)`; max is `a[j]` or −1.
3. Return the pairs.

Examples → [[2,2],[4,6],[15,−1]], [[−1,4]].

A path-shaped tree with 10^5 nodes and 10^5 queries would take about 10^10 steps if each query walked down from the root. Use an explicit stack for the traversal for the same reason.

Time: O((n + q) log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
