A binary tree has 1 to 10⁴ nodes with values from −10⁵ to 10⁵. Return true if removing exactly one edge can split it into two trees with equal sums. `[5,10,10,null,null,2,3]` → true (cut above the right child: 10 + 2 + 3 = 15 and 5 + 10 = 15). `[1,2,10,null,null,2,20]` → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One side is always a subtree

Removing the edge above node `v` splits off exactly the subtree rooted at `v`. So the question is whether some subtree other than the whole tree sums to `total / 2`.

1. Post-order: compute each subtree sum and record it in a list (or a multiset).
2. Remove the root's own sum (the total) from the list once.
3. Return true if `total` is even and `total / 2` is in what remains.

Leaving out the root's sum matters when `total = 0`: the whole tree sums to 0 = `total / 2`, but there is no edge above the root to cut. In `[0,-1,1]` the only subtree summing to 0 is the whole tree, so the answer is false.

Do not include the root's sum in the lookup. Do not halve an odd total with integer division; an odd total can never split evenly.

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
