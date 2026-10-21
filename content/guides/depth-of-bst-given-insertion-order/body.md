Given a permutation of 1 … n as the order in which values are inserted into an initially empty binary search tree, return the depth of the tree: the number of nodes on its longest root-to-leaf path. For instance, [2,1,4,3] → 3, [2,1,3,4] → 3, and [1,2,3,4] → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Insert by neighbours

1. Sorted structure of inserted keys with their depths.
2. For each `x`: find predecessor `a` and successor `b`; `depth[x] = 1 + max(depth[a], depth[b])` (missing → 0).
3. Answer = the maximum depth.

Constructed checks (verified against building the BST directly on random permutations): the three cases above → 3, 3, 4.

Of the two neighbours, the one inserted later sits below the other, and `x` attaches under it — the deeper one. Building the tree directly is O(n²) for sorted input.

Time: O(n log n)  
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
