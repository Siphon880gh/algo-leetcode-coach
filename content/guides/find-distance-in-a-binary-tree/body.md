Given the root of a binary tree and two node values p and q (both present), return the number of edges on the path between those two nodes. For instance, in the tree [3,5,1,6,2,0,8,null,null,7,4], p = 5 and q = 0 are 3 apart, p = 7 and q = 4 are 2 apart, and a node is 0 from itself. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Through the LCA

1. Standard LCA DFS: return the node if it is `p` or `q`; if both sides return non-null, this node is the LCA.
2. From the LCA, measure the depth of `p` and of `q`.
3. Answer = `dist(LCA, p) + dist(LCA, q)`.

Constructed checks on `[3,5,1,6,2,0,8,null,null,7,4]`: (5, 0) → 3, (7, 4) → 2, (6, 8) → 4, (5, 5) → 0.

Handle `p == q` before anything else. Do not add the two root depths without subtracting twice the LCA depth.

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
