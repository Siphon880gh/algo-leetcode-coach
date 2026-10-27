Given the root of an N-ary tree with unique values and two nodes p and q, move the subtree rooted at p to become the last child of q, handling the case where q lies inside p's subtree as the statement specifies (q is reconnected so the tree stays connected). If p is already a direct child of q, leave the tree unchanged. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Check ancestry first

1. DFS to record parents (or find p, q and whether q is in p's subtree).
2. If `parent[p] == q`, return root.
3. If q is in p's subtree: remove q from `parent[q].children`; replace p with q in `parent[p].children` (if p is the root, q becomes the new root).
4. Otherwise remove p from `parent[p].children`.
5. Append p to `q.children`.

For instance, with 1→{2,3}, 2→{4}: moving p = 2 under q = 4 detaches 4, puts 4 where 2 was under 1, and appends 2 to 4.

Do not move p under its own descendant without reconnecting; that creates a cycle and drops the subtree.

Time: O(n)  
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
