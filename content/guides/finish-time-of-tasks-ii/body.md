You get an undirected tree of n tasks as an edge list and an array baseTime. Using the finish-time rule from Finish Time of Tasks I, choose any task as the root and compute its finish time. Return the smallest finish time over all choices of root. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Reroot

1. down[v] = finish time of v's subtree with root 0 (leaf → baseTime).
2. Top-down: at v, the neighbor values are down[c] for children and up[v] for the parent side.
3. Finish with v as root = 2 · max − min + baseTime[v] (baseTime[v] if v has no neighbors). Keep the best.
4. up[c] = the same formula over v's neighbor values without c, using the top two and bottom two.

Assumed here: the finish rule is the one from part I, applied with every task tried as root.

Constructed checks (made-up values, run in code): edges [[0, 1], [1, 2], [1, 3]], baseTime = [2, 6, 1, 3] → 11; a path 0 − 1 − 2 − 3 − 4 with baseTime = [4, 1, 5, 2, 3] → 10. Checked against rooting at every node on 1,500 random trees.

Keeping root 0: the second check → 15 instead of 10.

Time: O(n log d) with sorting neighbor values, or O(n) with a top-two scan  
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
