Given the root of a binary tree, count the nodes whose value equals the sum of all their descendants' values (a node with no descendants has sum 0). For instance, the tree [10,3,4,2,1] → 2 (node 10 = 3 + 4 + 2 + 1, node 3 = 2 + 1), [2,3,null,2] → 0, and [0] → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Return subtree sums

`go(n)`: if null → 0; `s = go(n.left) + go(n.right)`; if `s == n.val`, count it; return `s + n.val`.

Constructed checks (verified with code): the three cases above → 2, 0, 1.

A leaf with value 0 counts, since its descendant sum is 0. Sums can exceed 32 bits on large trees; use 64-bit.

Time: O(n)  
Space: O(h)

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
