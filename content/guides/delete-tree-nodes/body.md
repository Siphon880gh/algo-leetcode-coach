A tree is given by a node count, a parent array (the root has parent −1), and node values. Delete every subtree whose values sum to 0, and return how many nodes remain. For instance, parents `[−1,0,0]` with values `[1,−1,0]` give 0 (the whole tree sums to 0), and values `[2,−1,1]` give 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Return (sum, count)

1. Build `children` from `parent`; find the root.
2. `go(u)`: `s = value[u]`, `c = 1`; for each child add its `(sum, count)`; if `s == 0`, return `(s, 0)`; else `(s, c)`.
3. Return `go(root).count`.

A zero-sum child still adds its sum (0) and nothing to the count, which is exactly removing it.

Do not delete only the node with value 0; the rule is about subtree sums. Do not compute each subtree sum separately; one post-order pass is O(n).

Time: O(n)  
Space: O(n)

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
